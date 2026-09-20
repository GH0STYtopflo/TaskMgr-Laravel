<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();

        return view('categories.index', ['categories' => $categories]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateCategoryRequest $request)
    {
        Category::create([
            'title' => $request->title,
        ]);

        return redirect('/categories');
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('categories.show', ['category' => $category]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CreateCategoryRequest $request, Category $category)
    {
        $category->update([
            'title' => $request->title,
        ]);

        return redirect('/categories/' . $category->id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect('/categories');
    }
}
