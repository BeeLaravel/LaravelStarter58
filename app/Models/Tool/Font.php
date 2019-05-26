<?php
namespace App\Models\Tool;

class Font extends Model {
    protected $fillable = ['title', 'slug', 'url', 'language', 'category', 'company', 'weight', 'description', 'note', 'sort', 'created_by', 'created_at', 'updated_at', 'created_by'];

    public function custom_fonts() { // 项目 一对多 反向
        return $this->hasMany('App\Models\Tool\CustomFont', 'font');
    }
}

