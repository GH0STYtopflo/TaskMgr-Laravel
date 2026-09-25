<?php

namespace App\Http\Requests\Subtasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSubtaskRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'title' => ['nullable', 'string'],
            'is_done' => ['nullable', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to update subtask. Reason: {$validator->errors()->first()}",
        $this->route('subtask'), $this->except(['_token']));

        parent::failedValidation($validator);
    }
}
