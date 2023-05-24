<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;

class BookController extends Controller
{
    public function index()
    {
        // Obtiene todos los libros
        $books = Book::all();

        return view('books.index', compact('books'));
    }

    public function create()
    {
        return view('books.create');
    }

    public function store(Request $request)
    {
        // Validar los datos a guardar
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'nullable',
            'img' => 'nullable',
            'ISBN' => 'required',
            'amount' => 'required',
            'status' => 'nullable',
            'created_at' => 'nullable',
            'updated_at' => 'nullable',
            // Add validation rules for other fields
        ]);

        // Crear un nuevo libro
        Book::create($validatedData);

        // Redirect to the index page or show success message
        return redirect()->route('books.index')->with('success', 'El libro se insertó correctamente.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(Request $request, Book $book)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'nullable',
            'description' => 'nullable',
            'ISBN' => 'nullable',
            'status' => 'nullable',
            'updated_at' => 'nullable',
            // Add validation rules for other fields
        ]);

        // Update the book
        $book->update($validatedData);

        // Redirect to the show page or show success message
        return redirect()->route('books.show', $book)->with('success', 'Book updated successfully');
    }

    public function destroy(Book $book)
    {
        // Delete the book
        $book->delete();

        // Redirect to the index page or show success message
        return redirect()->route('books.index')->with('success', 'Libro eliminado correctamente.');
    }
}
