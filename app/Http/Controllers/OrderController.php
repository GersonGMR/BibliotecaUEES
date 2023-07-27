<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $orders = Order::query()
            ->whereRaw('LOWER(user_id) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereHas('user', function ($query) use ($searchQuery) {
                $query->whereRaw('LOWER(email) LIKE ?', ['%' . strtolower($searchQuery) . '%']);
            })
            ->orWhereRaw('LOWER(note) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(quantity) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(return_date) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhere(function ($query) use ($searchQuery) {
                $lowercaseQuery = strtolower($searchQuery);
                if ($lowercaseQuery === 'activo') {
                    $query->where('status', 1); // Search for active status
                } elseif ($lowercaseQuery === 'inactivo') {
                    $query->where('status', 0); // Search for inactive status
                }
            })
            ->orWhereRaw('LOWER(created_at) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhere('id', 'like', "%$searchQuery%")
            ->paginate(10);

        return view('orders.index', compact('orders'));
    }

    public function create()
    {
        $books = Book::where('status', 1)->get();

        return view('orders.create', compact('books'));
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'user_id' => 'required',
            'note' => 'required',
            'quantity' => 'required|integer|min:1',
            'book_id' => 'required',
        ]);

        // Create the order
        $order = Order::create([
            'user_id' => $request->input('user_id'),
            'note' => $request->input('note'),
            'quantity' => $request->input('quantity'),
        ]);

        // Create the order detail
        $orderDetail = OrderDetail::create([
            'order_id' => $order->id,
            'book_id' => $request->input('book_id'),
            'amount' => $request->input('quantity'), // Adjust as per your requirements
        ]);

        // Redirect or perform any other actions after successful creation
        return redirect()->route('orders.index')->with('success', 'La orden se registró correctamente.');
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

    public function edit(Order $order)
    {
        return view('orders.edit', ['order' => $order]);
    }

    public function update(Request $request, Order $order)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'note' => 'nullable',
            'status' => 'required|boolean'
            // Add validation rules for other fields
        ]);
        // Find the order by ID
        $order = Order::findOrFail($order->id);

        // Update the order
        $order->update($validatedData);

        // Redirect to the show page or show success message
        return redirect()->route('orders.index', $order)->with('success', 'El libro se actualizó correctamente');
    }

    public function softDelete(Order $order)
    {
        $order->update(['status' => 0]);

        return redirect()->route('orders.index')->with('success', 'El libro ha sido deshabilitado.');
    }

    public function destroy(Order $order)
    {
        // Delete the order
        $order->delete();

        // Redirect to the index page or show success message
        return redirect()->route('orders.index')->with('success', 'Libro eliminado correctamente.');
    }

    
}
