<?php

namespace App\Actions\Categories;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;

class CategoryIndexAction
{
    public static function do(): Collection
    {
        $categories = Category::all();

        LogAction::do(Auth::user(), ActionStatus::SUCCESS, "Indexed Categories.", Category::class);

        return $categories;
    }
}
