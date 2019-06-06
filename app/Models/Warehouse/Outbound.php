<?php
namespace App\Models\Warehouse;

class Outbound extends Model {
    protected $fillable = ['slug', 'description', 'sort', 'created_by', 'created_at', 'updated_at'];

    // public function language() { // 项目 一对多 反向
    //     return $this->belongsTo('App\Models\Structure\CategoryItem');
    // }
    // public function custom_fonts() { // 项目 一对多 反向
    //     return $this->hasMany('App\Models\Tool\CustomFont');
    // }
}

