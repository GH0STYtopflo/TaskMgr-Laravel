<?php

namespace App\Http\Requests\Comments;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Comment;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class QueryCommentsRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['nullable', 'string'],
            'task_id' => ['nullable', 'integer'],
            'after' => ['nullable', 'date'],
            'before' => ['nullable', 'date'],
            'keyword' => ['nullable', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to query comments. Reason: {$validator->errors()->first()}",
        Comment::class);

        parent::failedValidation($validator);
    }
}
