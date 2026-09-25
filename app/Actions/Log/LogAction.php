<?php

namespace App\Actions\Log;

use App\Enums\ActionStatus;
use App\Models\Log;
use App\Models\User;
use http\Message;
use Illuminate\Database\Eloquent\Model;

class LogAction
{
    public static function do(User $by, ActionStatus $status, string $message , string | Model | null $resource = null, $data = null): void
    {
        Log::create([
            'message' => $message,
            'resource_id' => is_null($resource) || is_string($resource) ? null : $resource->id,
            'user_id' => $by->id,
            'action_status' => $status->name,
            'resource_type' => is_string($resource) || is_null($resource) ? null : strtoupper(class_basename(get_class($resource))),
            'data' => json_encode($data),
        ]);
    }
}
