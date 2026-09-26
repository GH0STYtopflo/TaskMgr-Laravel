<?php

namespace App\Http\Controllers;

use App\Actions\Categories\CategoryIndexAction;
use App\Actions\Categories\CreateCategoryAction;
use App\Actions\Categories\DeleteCategoryAction;
use App\Actions\Categories\UpdateCategoryAction;
use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Models\Category;
use Auth;

class CategoryController extends Controller
{
    public function index()
    {
        return view('categories.index', ['categories' => CategoryIndexAction::do()]);
    }

    public function store(CreateCategoryRequest $request)
    {
        CreateCategoryAction::do($request);

        return redirect()->route('categories.index');
    }

    public function show(Category $category)
    {
        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Viewed category.", $category);

        return view('categories.show', ['category' => $category]);
    }

    public function update(CreateCategoryRequest $request, Category $category)
    {
        UpdateCategoryAction::do($request, $category);

        return redirect()->route('categories.show', ['category' => $category]);
    }

    public function destroy(Category $category)
    {
        DeleteCategoryAction::do($category);

        return redirect()->route('categories.index');
    }
}
