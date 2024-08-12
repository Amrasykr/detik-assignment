<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use App\Exports\BookExport;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class BookController extends Controller
{
    private function deletePublicFile($fileName, $directory)
    {
        $filePath = public_path($directory . '/' . $fileName);
        if (File::exists($filePath)) {
            File::delete($filePath);
        }
    }

    private function handleFileUpload($file, $directory)
    {
        $fileName = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $fileExtension = $file->getClientOriginalExtension();
        $newFileName = $fileName . '-' . uniqid() . '.' . $fileExtension;
        $file->move(public_path($directory), $newFileName);
        return $newFileName;
    }

    public function index(Request $request)
    {
        $categories = Category::all();

        $booksQuery = Auth::user()->role == 'admin'
            ? Book::query()
            : Book::where('author_id', Auth::id());

        if ($request->has('category_id') && $request->category_id != '') {
            $booksQuery->where('category_id', $request->category_id);
        }

        $books = $booksQuery->paginate(5);

        if ($request->ajax()) {
            return view('pages.book._table', compact('books'))->render();
        }

        return view('pages.book.index', compact('books', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('pages.book.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'cover_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_file' => 'required|mimes:pdf|max:2048',
            'quantity' => 'required|integer',
        ]);

        $cover_image = $this->handleFileUpload($request->file('cover_image'), 'assets/book_covers');
        $pdf_file = $this->handleFileUpload($request->file('pdf_file'), 'assets/book_files');

        $book = new Book([
            'name' => $validated_data['name'],
            'category_id' => $validated_data['category_id'],
            'description' => $validated_data['description'],
            'cover_image' => $cover_image,
            'pdf_file' => $pdf_file,
            'author_id' => Auth::id(),
            'quantity' => $validated_data['quantity'],
        ]);

        $book->save();

        notify()->success(message:'Book created successfully');
        return redirect()->route('books.index');
    }

    public function edit(string $id)
    {
        $book = Book::findOrFail($id);
        $categories = Category::all();

        return view('pages.book.edit', compact('book', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $book = Book::findOrFail($id);

        $validated_data = $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'pdf_file' => 'nullable|mimes:pdf|max:2048',
            'quantity' => 'required|integer',
        ]);

        if ($request->hasFile('cover_image')) {
            if ($book->cover_image) {
                $this->deletePublicFile($book->cover_image, 'assets/book_covers');
            }
            $cover_image = $this->handleFileUpload($request->file('cover_image'), 'assets/book_covers');
        } else {
            $cover_image = $book->cover_image;
        }

        if ($request->hasFile('pdf_file')) {
            if ($book->pdf_file) {
                $this->deletePublicFile($book->pdf_file, 'assets/book_files');
            }
            $pdf_file = $this->handleFileUpload($request->file('pdf_file'), 'assets/book_files');
        } else {
            $pdf_file = $book->pdf_file;
        }

        $book->update([
            'name' => $validated_data['name'],
            'category_id' => $validated_data['category_id'],
            'description' => $validated_data['description'],
            'cover_image' => $cover_image,
            'pdf_file' => $pdf_file,
            'quantity' => $validated_data['quantity'],
        ]);

        notify()->success(message: 'Book updated successfully');
        return redirect()->route('books.index');
    }

    public function destroy($id)
    {
        $book = Book::findOrFail($id);

        if ($book->cover_image) {
            $this->deletePublicFile($book->cover_image, 'assets/book_covers');
        }

        if ($book->pdf_file) {
            $this->deletePublicFile($book->pdf_file, 'assets/book_files');
        }

        $book->delete();

        notify()->success(message: 'Book deleted successfully');
        return redirect()->route('books.index');
    }

    public function show($id)
    {
        $book = Book::findOrFail($id);
        return view('pages.book.show', compact('book'));
    }

    public function download($id)
    {
        $book = Book::findOrFail($id);

        if ($book->pdf_file && File::exists(public_path('assets/book_files/' . $book->pdf_file))) {
            return response()->download(public_path('assets/book_files/' . $book->pdf_file));
        } else {
            notify()->error(message: 'File not found.');
            return redirect()->route('books.index');
        }
    }

    public function exportExcel()
    {
        return Excel::download(new BookExport, 'books.xlsx');
    }

    public function exportPdf()
    {
        $books = Book::with('category', 'user')->get();
        $formattedBooks = $books->map(function($book) {
            $book->created_at_formatted = Carbon::parse($book->created_at)->format('l j F Y');
        return $book;
        });
        $pdf = PDF::loadView('exports.books', compact('formattedBooks'));
        return $pdf->download('books.pdf');
    }

}
