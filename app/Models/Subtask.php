<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Guarded()]
class Subtask extends Model
{
    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
