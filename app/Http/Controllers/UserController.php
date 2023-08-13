<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use App\Models\Role;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $users = User::query()
            ->whereRaw('LOWER(role_id) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(first_name) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(last_name) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(adress) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(phone) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(email) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
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

        return view('users.index', compact('users'));
    }

    public function create()
    {
        $roles = Role::all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        // Validar los datos a guardar
        $validatedData = $request->validate([
            'role_id' => 'required',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'adress' => 'nullable',
            'phone' => 'nullable',
            'email' => 'required',
            'status' => 'nullable',
            'password' => 'required',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
            // Add validation rules for other fields
        ]);

        $existingUser = User::where('email', $validatedData['email'])
            ->whereNotNull('email') // Add this condition to exclude NULL values
            ->first();

        if ($existingUser !== null) {
            return redirect()->back()->withErrors(['email' => 'ERROR: El correo electrónico ingresado ya existe.'])->withInput();
        }

        // Hash the password if it is provided
        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Crear un nuevo libro
        User::create($validatedData);

        // Redirect to the index page or show success message
        return redirect()->route('users.index')->with('success', 'El usuario se registró correctamente.');
    }

    public function show(User $user)
    {
        return view('users.show', compact('user'));
    }

    public function edit(User $user)
    {
        $roles = Role::all();

        return view('users.edit', ['user' => $user, 'roles' => $roles]);
    }

    public function update(Request $request, User $user)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'role_id' => 'nullable',
            'first_name' => 'nullable',
            'last_name' => 'nullable',
            'adress' => 'nullable',
            'phone' => 'nullable',
            'email' => 'nullable',
            'status' => 'required|boolean',
            // Add validation rules for other fields
        ]);
        // Find the user by ID
        $user = User::findOrFail($user->id);

        // Hash the password if it is provided
        if ($request->has('password')) {
            $validatedData['password'] = Hash::make($validatedData['password']);
        }

        // Update the user
        $user->update($validatedData);

        // Redirect to the show page or show success message
        return redirect()->route('users.index')->with('success', 'El usuario se actualizó correctamente');
    }

    public function softDelete(User $user)
    {
        $user->update(['status' => 0]);

        return redirect()->route('users.index')->with('success', 'El usuario ha sido deshabilitado.');
    }

    public function destroy(User $user)
    {
        // Delete the user
        $user->delete();

        // Redirect to the index page or show success message
        return redirect()->route('users.index')->with('success', 'Usuario eliminado correctamente.');
    }
}
