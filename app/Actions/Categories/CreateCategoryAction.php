<?php

namespace App\Actions\Categories;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Http\Requests\Categories\CreateCategoryRequest;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class CreateCategoryAction
{
    public static function do(CreateCategoryRequest $request): void
    {
        $category = Category::create([
            'title' => $request->title,
        ]);

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Category created.", $category, $request->except('_token'));
    }
}
