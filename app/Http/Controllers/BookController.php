<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Picqer\Barcode\BarcodeGeneratorPNG;

class BookController extends Controller
{
    /*public function index1(Request $request)
    {
        // Obtiene todos los libros y los ordena por status en orden descendente
        $books = Book::orderBy('status', 'desc')->paginate(10); // Ordena por status en orden descendente y aplica paginación, 10 libros por página
        return view('books.index', ['books' => $books]);
    }
    */
    public function index(Request $request)
    {
        $searchQuery = $request->input('search');

        $books = Book::query()
            ->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(description) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(isbn) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhere(function ($query) use ($searchQuery) {
                $lowercaseQuery = strtolower($searchQuery);
                if ($lowercaseQuery === 'activo') {
                    $query->where('status', 1); // Search for active status
                } elseif ($lowercaseQuery === 'inactivo') {
                    $query->where('status', 0); // Search for inactive status
                }
            })
            ->orWhereRaw('LOWER(created_at) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhereRaw('LOWER(amount) LIKE ?', ['%' . strtolower($searchQuery) . '%'])
            ->orWhere('id', 'like', "%$searchQuery%")
            ->paginate(10);

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

        // Check if the ISBN code already exists
        $existingBook = Book::where('ISBN', $validatedData['ISBN'])->first();
        if ($existingBook) {
            return redirect()->back()->withErrors(['ISBN' => 'ERROR: El código ISBN ingresado ya existe.'])->withInput();
        }

        $isbn = $request->input('ISBN');

        $generator = new BarcodeGeneratorPNG();
        $barcodeData = 'data:image/png;base64,' . base64_encode($generator->getBarcode($isbn, $generator::TYPE_EAN_13));
        $validatedData['barcode_image'] = $barcodeData;

        $book = new Book($validatedData);
        $book->save();

        return redirect()->route('books.index')->with('success', 'El libro se insertó correctamente.');
    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
    }

    public function edit(Book $book)
    {
        return view('books.edit', ['book' => $book]);
    }

    public function update(Request $request, Book $book)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'nullable',
            'description' => 'nullable',
            'ISBN' => 'required',
            'amount' => 'nullable',
            'status' => 'required|boolean',
            // Add validation rules for other fields
        ]);

        $isbn = $request->input('ISBN');

        $generator = new BarcodeGeneratorPNG();
        $barcodeData = 'data:image/png;base64,' . base64_encode($generator->getBarcode($isbn, $generator::TYPE_EAN_13));
        $validatedData['barcode_image'] = $barcodeData;

        // Update the book
        $book->update($validatedData);

        
        // Redirect to the show page or show success message
        return redirect()->route('books.index', $book)->with('success', 'El libro se actualizó correctamente');
    }

    public function softDelete(Book $book)
    {
        $book->update(['status' => 0]);

        return redirect()->route('books.index')->with('success', 'El libro ha sido deshabilitado.');
    }

    public function destroy(Book $book)
    {
        // Delete the book
        $book->delete();

        // Redirect to the index page or show success message
        return redirect()->route('books.index')->with('success', 'Libro eliminado correctamente.');
    }
}
