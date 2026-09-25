<?php

namespace App\Http\Controllers;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Indexed Categories.", Category::class);

        return view('categories.index', ['categories' => $categories]);
    }

    public function store(CreateCategoryRequest $request)
    {
        $category = Category::create([
            'title' => $request->title,
        ]);

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Category created.", $category, $request->except('_token'));

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Viewed category.", $category);

        return view('categories.show', ['category' => $category]);
    }

    public function update(CreateCategoryRequest $request, Category $category)
    {
        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Category created.", $category, $request->except('_token'));

        $category->update([
            'title' => $request->title,
        ]);

        return redirect()->route('categories.show', ['category' => $category]);
    }

    public function destroy(Category $category)
    {
        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Category deleted.", $category);

        $category->delete();

        return redirect('/categories');
    }
}
