<?php

namespace App\Http\Requests\Categories;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Category;
use Illuminate\Foundation\Http\FormRequest;
use Validator;

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

    protected function failedValidation(Validator|\Illuminate\Contracts\Validation\Validator $validator): void
    {
        LogAction::do(\Auth::user(), ActionStatus::FAILURE,
            "Failed to create or update category. Reason: {$validator->errors()->first()}",
        Category::class, $this->except('_token'));

        parent::failedValidation($validator);
    }
}
