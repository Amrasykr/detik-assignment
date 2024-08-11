<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;


class BookController extends Controller
{

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
        return view('pages.book.create');
    }

    public function store(Request $request)
    {
        dd($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
