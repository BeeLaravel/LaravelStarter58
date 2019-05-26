<?php
namespace App\Models\Tool;

use Vinkla\Hashids\Facades\Hashids;

class CustomFont extends Model {
    protected $fillable = ['title', 'content', 'font', 'sort', 'created_by', 'created_at', 'updated_at', 'created_by'];

    public function font() { // 项目 一对多 反向
        return $this->belongsTo('App\Models\Tool\Font');
    }

    public function getUrlAttribute() {
        return 'app/custom_fonts/'.Hashids::encode($this->id).'.ttf';
    }
}

