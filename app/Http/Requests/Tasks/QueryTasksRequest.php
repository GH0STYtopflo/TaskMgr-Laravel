<?php

namespace App\Http\Requests\Tasks;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\Task;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class QueryTasksRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'plt' => ['nullable', 'integer'],
            'pgt' => ['nullable', 'integer'],
            'created_before' => ['nullable', 'date'],
            'created_after' => ['nullable', 'date'],
            'status' => ['nullable', 'string'],
            'deadline_after' => ['nullable', 'date'],
            'deadline_before' => ['nullable', 'date'],
            'order_by' => ['nullable', 'string'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to query tasks. Reason: " . $validator->errors()->first(),
            Task::class, $this->except('_token'));

        parent::failedValidation($validator);
    }
}
