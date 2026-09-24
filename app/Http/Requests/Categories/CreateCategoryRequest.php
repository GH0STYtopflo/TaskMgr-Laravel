<?php

namespace App\Http\Requests\Categories;

use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Used for both creating and updating categories
 */
class CreateCategoryRequest extends FormRequest
{
    public function rules(Category $category): array
    {
        $cat = $this->route('category');

        return [
            'title' => ['required', 'string', 'max:255', function ($attribute, $value, $fail) use ($cat) {
                if (!is_null($cat) && $cat->title === $value) {
                    return;
                }

                if (Category::where('title', $value)->exists()) {
                    $fail("Category already exists.");
                }
            }],
        ];
    }
}
