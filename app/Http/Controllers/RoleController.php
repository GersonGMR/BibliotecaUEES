<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;

class RoleController extends Controller
{
        /*public function index1(Request $request)
        {
            // Obtiene todos los libros y los ordena por status en orden descendente
            $roles = Role::orderBy('status', 'desc')->paginate(10); // Ordena por status en orden descendente y aplica paginación, 10 libros por página
            return view('roles.index', ['roles' => $roles]);
        }
        */
        public function index(Request $request)
        {
            $searchQuery = $request->input('search');
    
            $roles = Role::query()
                ->orWhereRaw('LOWER(role_name) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
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
    
            return view('roles.index', compact('roles'));
        }
    
        public function create()
        {
            return view('roles.create');
        }
    
        public function store(Request $request)
        {
            // Validar los datos a guardar
            $validatedData = $request->validate([
                'role_name' => 'required',
                // Add validation rules for other fields
            ]);
    
            // Crear un nuevo libro
            Role::create($validatedData);
    
            // Redirect to the index page or show success message
            return redirect()->route('roles.index')->with('success', 'El rol se insertó correctamente.');
        }
    
        public function show(Role $role)
        {
            return view('roles.show', compact('role'));
        }
    
        public function edit(Role $role)
        {
            return view('roles.edit', ['role' => $role]);
        }
    
        public function update(Request $request, Role $role)
        {
            // Validate the request data
            $validatedData = $request->validate([
                'role_name' => 'nullable',
                'status' => 'required|boolean',
                // Add validation rules for other fields
            ]);
            // Find the role by ID
            $role = Role::findOrFail($role->id);
    
            // Update the role
            $role->update($validatedData);
    
            // Redirect to the show page or show success message
            return redirect()->route('roles.index', $role)->with('success', 'El rol se actualizó correctamente');
        }
    
        public function softDelete(Role $role)
        {
            $role->update(['status' => 0]);
    
            return redirect()->route('roles.index')->with('success', 'El rol ha sido deshabilitado.');
        }
    
        public function destroy(Role $role)
        {
            // Delete the role
            $role->delete();
    
            // Redirect to the index page or show success message
            return redirect()->route('roles.index')->with('success', 'Rol eliminado correctamente.');
        }
}
