<?php
namespace App\Models\Tool;

class Account extends Model {
    protected $fillable = ['title', 'url', 'account', 'password', 'description', 'category_id', 'type_id', 'sort', 'created_by', 'created_at', 'updated_at'];
}

