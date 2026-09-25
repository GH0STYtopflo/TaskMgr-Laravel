<?php

namespace App\Http\Requests\Users;

use App\Actions\Log\LogAction;
use App\Enums\ActionStatus;
use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;

class QueryUsersRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'username' => ['nullable', 'string'],
            'id' => ['nullable', 'integer'],
            'before' => ['nullable', 'date'],
            'after' => ['nullable', 'date'],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        LogAction::do(\Auth::user(), ActionStatus::FAILURE, "Failed to query users. Reason: " . $validator->errors()->first(),
        User::class, $this->except('_token'));

        parent::failedValidation($validator);
    }
}
