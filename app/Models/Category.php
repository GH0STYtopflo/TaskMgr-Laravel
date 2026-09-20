<?php

namespace App\Models;

use Database\Factories\CategoryFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Guarded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

#[Guarded()]
#[Fillable('title')]
class Category extends Model
{
    // Disable timestamps for this particular model. Learned something new
    public $timestamps = false;

    /** @use HasFactory<CategoryFactory> */
    use HasFactory;

    public function tasks(): BelongsToMany
    {
        return $this->belongsToMany(Task::class);
    }
}
