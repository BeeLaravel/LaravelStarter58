<?php
namespace App\Models\Config;

class Configure extends Model {
    protected $fillable = ['title', 'content', 'company_id', 'sort', 'created_by', 'created_at', 'updated_at', 'created_by'];
}
