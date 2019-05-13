<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class LogDatabase extends Model
{
    protected $fillable = ['operation_type', 'type', 'sql', 'description', 'status', 'result', 'created_at', 'created_by'];
}
