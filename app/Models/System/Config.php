<?php

namespace App\Models\System;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $fillable = ['type', 'unique_slug', 'key', 'value', 'created_at', 'updated_at', 'created_by'];
}
