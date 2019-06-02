<?php
namespace App\Models\Warehouse;

class Product extends Model {
    protected $fillable = ['slug', 'title', 'description', 'category_id', 'sort', 'created_by', 'created_at', 'updated_at'];
}
