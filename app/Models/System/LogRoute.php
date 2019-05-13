<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class LogRoute extends Model
{
    protected $fillable = ['type', 'unique_slug', 'key', 'value', 'created_at', 'created_by'];
}
