<?php
namespace App\Models\Tool;

class Font extends Model {
    protected $fillable = ['title', 'slug', 'url', 'language_id', 'category_id', 'company_id', 'weight_id', 'description', 'note', 'sort', 'created_by', 'created_at', 'updated_at', 'created_by'];

    public function language() { // 项目 一对多 反向
        return $this->belongsTo('App\Models\Structure\CategoryItem');
    }
    public function custom_fonts() { // 项目 一对多 反向
        return $this->hasMany('App\Models\Tool\CustomFont');
    }
}

