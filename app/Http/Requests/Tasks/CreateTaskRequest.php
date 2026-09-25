<?php

namespace App\Http\Requests\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Task;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class CreateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['string'],
            'deadline' => ['required', 'date', 'after_or_equal:today'],
            'users' => ['nullable', 'array'],
            'categories' => ['nullable', 'array'],
            'subtasks' => ['nullable', 'string', 'max:5000'],
            'priority' => ['required', 'integer', 'min:1', 'max:20'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed validation. Reason: " . $validator->errors()->first(),
        Task::class, $this->except('_token'));

        parent::failedValidation($validator);
    }
}
