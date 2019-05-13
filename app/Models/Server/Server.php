<?php

namespace App\Models\Server;

use Illuminate\Database\Eloquent\Model;

class Server extends Model
{
    protected $fillable = ['type', 'unique_slug', 'key', 'value', 'created_at', 'updated_at', 'created_by'];
}
