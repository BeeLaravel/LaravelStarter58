<?php
namespace App\Models\Warehouse;

class Location extends Model {
    protected $fillable = ['slug', 'title', 'description', 'area_id', 'warehouse_id', 'sort', 'created_by', 'created_at', 'updated_at'];
}

