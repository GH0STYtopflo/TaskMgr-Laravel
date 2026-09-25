<?php

namespace App\Http\Requests\Comments;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Comment;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class CreateOrUpdateTaskCommentRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'body' => ['required', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        LogAction::do(Auth::user(), ActionStatus::FAILURE, "Failed to update or create comments. Reason: {$validator->errors()->first()}",
        Comment::class, request()->except('_token'));

        parent::failedValidation($validator);
    }
}
