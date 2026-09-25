<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;

#[Table(name: 'action_logs')]
#[Fillable('resource_id', 'user_id', 'resource_type', 'action_status', 'data', 'message')]
class Log extends Model
{
    public $timestamps = false;
    public $incrementing = false;
    protected $primaryKey = null;
}
