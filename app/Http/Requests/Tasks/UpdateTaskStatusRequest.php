<?php

namespace App\Http\Requests\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskStatusRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'task_is_done' => ['nullable', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to update task status Reason: " . $validator->errors()->first(),
            $this->route('task'), $this->except('_token'));

        parent::failedValidation($validator);
    }
}
