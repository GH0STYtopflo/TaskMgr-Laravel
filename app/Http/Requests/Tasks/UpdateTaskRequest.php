<?php

namespace App\Http\Requests\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UpdateTaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'deadline' => ['required', 'date', 'after_or_equal:now'],
            'users' => ['nullable', 'array'],
            'categories' => ['nullable', 'array'],
            'subtasks' => ['nullable', 'string', 'max:5000'],
            'priority' => ['required', 'integer', 'min:1', 'max:20'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        LogAction::do(Auth::user(), ActionStatus::FAILURE, "Failed to update task. Reason: " . $validator->errors()->first(),
        $this->route('task'), $this->except('_token'));

        parent::failedValidation($validator);
    }
}
