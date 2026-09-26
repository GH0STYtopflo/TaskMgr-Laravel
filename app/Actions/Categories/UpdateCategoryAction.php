<?php

namespace App\Actions\Categories;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class UpdateCategoryAction
{
    public static function do(CreateCategoryRequest $request, Category $category): void
    {
        $category->update([
            'title' => $request->title,
        ]);

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Category created.", $category, $request->except('_token'));
    }
}
