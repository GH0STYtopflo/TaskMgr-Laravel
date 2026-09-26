<?php

namespace App\Actions\Categories;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class DeleteCategoryAction
{
    public static function do(Category $category): void
    {
        $category->delete();

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Category deleted.", $category);
    }
}
