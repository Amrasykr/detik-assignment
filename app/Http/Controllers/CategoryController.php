<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;


class CategoryController extends Controller
{

    public function index(Request $request)
    {
        $search = $request->input('search');
        $categoriesQuery = Category::query();

        if ($search) {
            $categoriesQuery->where(function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            });
        }

        $categories = $categoriesQuery->paginate(5);
        return view('pages.category.index', compact('categories', 'search'));
    }

    public function create()
    {
        return view('pages.category.create');
    }

    public function store(Request $request)
    {
        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories = Category::create([
            'name' => $validated_data['name'],
        ]);

        if ($categories) {
            notify()->success(message: 'Category Created Successfully');
            return redirect()->route('categories.index');
        } else {
            notify()->error(message: 'Category Creation Failed');
            return redirect()->route('categories.index');
        }
    }

    public function edit(string $id)
    {
        $category = Category::findOrFail($id);
        return view('pages.category.edit', compact('category'));
    }

    public function update(Request $request, string $id)
    {
        $categories = Category::findOrFail($id);

        $validated_data = $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $categories->update([
            'name' => $validated_data['name'],
        ]);

        if ($categories) {
            notify()->success(message: 'Category Updated Successfully');
            return redirect()->route('categories.index');
        } else {
            notify()->error(message: 'Category Update Failed');
            return redirect()->route('categories.index');
        }
    }

    public function destroy(string $id)
    {
        $categories = Category::findOrFail($id);
        $categories->delete();

        if ($categories) {
            notify()->success(message: 'Category Deleted Successfully');
            return redirect()->route('categories.index');
        } else {
            notify()->error(message: 'Category Deletion Failed');
            return redirect()->route('categories.index');
        }
    }
}
