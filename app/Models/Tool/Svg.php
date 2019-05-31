<?php
namespace App\Models\Tool;

class Svg extends Model {
    protected $fillable = ['title', 'url', 'category_id', 'sort', 'created_by', 'created_at', 'updated_at', 'created_by'];
}
