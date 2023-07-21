<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Support\Facades\Response;

class EstudianteController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $books = Book::query()
            ->where(function ($query) use ($searchQuery) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                    ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
                    ->orWhere('id', 'like', "%$searchQuery%");
            })
            ->where('status', 1) // Filter books with status 1 (active)
            ->where('amount', '>', 0) // Filter books with amount greater than 0
            ->paginate(7);

        return view('estudiante.index', compact('books'));
    }

    public function alquilarIndex(Request $request, Book $book)
    {
        // Get the current logged-in user instance
        $user = Auth::user();

        $userEmail = $user->email;

        $userId = $user->id;

        // Pass the user data and book data to the voucher view
        return view('estudiante.voucher', [
            'book' => $book,
            'userEmail' => $userEmail,
            'userId' => $userId
        ]);
    }

    public function alquilarBook(Request $request)
    {
        // Validate the request data
        $request->validate([
            'book_id' => 'required|exists:books,id'
        ]);

        // Get the current logged-in user instance
        $user = Auth::user();

        // Create a new order
        $order = new Order();
        $order->user_id = $user->id;
        $order->note = 'Alquiler de libro';
        $order->quantity = 1;
        $order->save();

        // Insert the order details into the 'order_details' table
        $orderDetail = new OrderDetail();
        $orderDetail->order_id = $order->id;
        $orderDetail->book_id = $request->input('book_id');
        $orderDetail->amount = 1;
        $orderDetail->save();

        // Subtract one book from the 'amount' field of the 'books' table
        $book = Book::find($request->input('book_id'));
        $book->amount -= 1;
        $book->save();

        // Generate the voucher view data
        $voucherData = [
            'userEmail' => $user->email,
            'userId' => $user->id,
            'book' => $book, // Pass the entire book model to the view
            'description' => $book->description,
            'barcode_image' => $book->barcode_image,
            // Add other data needed for the voucher view
        ];

        $pdf = \PDF::loadView('estudiante.alquilar_voucher', $voucherData);

        // Store the generated PDF file
        $fileName = 'voucher-' . time() . '.pdf';
        $pdfPath = storage_path('app/public/pdfs/' . $fileName);
        $pdf->save($pdfPath);

        // Update the order record with the PDF file path
        $order->comprobante = $fileName;
        $order->save();

        // Return a success message
        return redirect()->route('estudiante.index')->with('success', 'Libro alquilado correctamente.');
    }

    public function rentSummary()
    {
        // Get the current logged-in user instance
        $user = Auth::user();

        // Fetch the user's rents with the related book details
        $rents = Order::where('user_id', $user->id)
            ->with('orderDetails.book')
            ->orderByDesc('created_at')
            ->paginate(10);

        // Pass the rents data and user email to the rent_summary view
        return view('estudiante.resumen', compact('rents', 'user'));
    }

    public function downloadComprobante(Order $order)
    {
        $pdfPath = storage_path('app/public/pdfs/' . $order->comprobante);

        $response = Response::download($pdfPath, $order->id . $order->user_id . '.pdf');

        $response->headers->set('Content-Type', 'application/pdf');
        $response->headers->set('Content-Disposition', 'attachment; filename="voucher.pdf"');

        return $response;
    }
}
