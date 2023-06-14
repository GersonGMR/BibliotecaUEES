<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $orders = Order::query()
            ->whereRaw('LOWER(user_id) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
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
            ->latest() // Order by latest created_at column
            ->limit(5) // Retrieve only the last 5 rows
            ->get();

        return view('index', compact('orders'));
    }
}
