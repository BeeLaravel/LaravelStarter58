<?php
namespace App\Models\Tool;

class Package extends Model {
    protected $fillable = ['title', 'slug', 'language', 'category', 'description', 'note', 'sort', 'created_by', 'created_at', 'updated_at', 'created_by'];
}

