<?php

namespace App\Http\Requests\Tasks;

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
}
