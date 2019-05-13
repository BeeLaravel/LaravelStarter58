<?php

namespace App\Models\Server;

use Illuminate\Database\Eloquent\Model;

class Protocol extends Model
{
    protected $table = 'server_protocols';

    protected $fillable = ['type', 'key', 'value', 'created_at', 'updated_at', 'created_by'];

    // 作用域
    public function scopeDatabase($query) {
        return $query->where('type', 'database');
    }
}
