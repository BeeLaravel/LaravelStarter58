<?php
namespace App\Models\Basic;

class Currency extends Model {
    protected $fillable = ['slug', 'title', 'description', 'sort', 'created_by', 'created_at', 'updated_at'];

    // public function language() { // 项目 一对多 反向
    //     return $this->belongsTo('App\Models\Structure\CategoryItem');
    // }
    // public function custom_fonts() { // 项目 一对多 反向
    //     return $this->hasMany('App\Models\Tool\CustomFont');
    // }
}

