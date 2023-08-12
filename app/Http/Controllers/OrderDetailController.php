<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderDetail;

class OrderDetailController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $ordersdetails = OrderDetail::query()
            ->whereRaw('LOWER(order_id) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereHas('book', function ($query) use ($searchQuery) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchQuery) . '%']);
            })
            ->orWhereRaw('LOWER(book_id) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(amount) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(created_at) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhere('id', 'like', "%$searchQuery%")
            ->orderBy('created_at', 'desc')
            ->with(['order.user'])
            ->paginate(10);

        return view('ordersDetails.index', compact('ordersdetails'));
    }

    public function create()
    {
        return view('ordersDetails.create');
    }

    public function store(Request $request)
    {
        // Validar los datos a guardar
        $validatedData = $request->validate([
            'order_id' => 'required',
            'book_id' => 'required',
            'amount' => 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
            // Add validation rules for other fields
        ]);

        // Crear un nuevo libro
        OrderDetail::create($validatedData);

        // Redirect to the index page or show success message
        return redirect()->route('ordersDetails.index')->with('success', 'La orden se insertó correctamente.');
    }

    public function show(OrderDetail $orderdetail)
    {
        return view('ordersDetails.show', compact('orderdetail'));
    }

    public function edit(OrderDetail $orderdetail)
    {
        return view('ordersDetails.edit', ['orderdetail' => $orderdetail]);
    }

    public function update(Request $request, OrderDetail $orderdetail)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'order_id' => 'nullable',
            'book_id' => 'nullable',
            'amount' => 'nullable',
            // Add validation rules for other fields
        ]);
        // Find the user by ID
        $orderdetail = OrderDetail::findOrFail($orderdetail->id);

        // Update the user
        $orderdetail->update($validatedData);

        // Redirect to the show page or show success message
        return redirect()->route('ordersDetails.index', $orderdetail)->with('success', 'La orden se actualizó correctamente');
    }

    public function softDelete(OrderDetail $orderdetail)
    {
        $orderdetail->update(['status' => 0]);

        return redirect()->route('ordersDetails.index')->with('success', 'La orden ha sido deshabilitada.');
    }

    public function destroy(OrderDetail $orderdetail)
    {
        // Delete the user
        $orderdetail->delete();

        // Redirect to the index page or show success message
        return redirect()->route('ordersDetails.index')->with('success', 'Orden eliminado correctamente.');
    }
}
