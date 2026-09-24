<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', ['categories' => $categories]);
    }

    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'title' => $request->title,
        ]);

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        return view('categories.show', ['category' => $category]);
    }

    public function update(CreateCategoryRequest $request, Category $category)
    {
        $category->update([
            'title' => $request->title,
        ]);

        return redirect()->route('categories.show', ['category' => $category]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories');
    }
}
