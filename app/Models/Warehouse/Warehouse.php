<?php
namespace App\Models\Warehouse;

class Warehouse extends Model {
    protected $fillable = ['slug', 'title', 'description', 'type', 'sort', 'created_by', 'created_at', 'updated_at'];
}

