<?php
namespace App\Models\Config;

class Environment extends Model {
    protected $fillable = ['key', 'value', 'company_id', 'sort', 'created_by', 'created_at', 'updated_at', 'created_by'];
}

