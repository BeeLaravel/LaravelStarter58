<?php
namespace App\Models\Warehouse;

use Vinkla\Hashids\Facades\Hashids;

class Area extends Model {
    protected $fillable = ['slug', 'title', 'description', 'warehouse_id', 'sort', 'created_by', 'created_at', 'updated_at'];

    public function font() { // 项目 一对多 反向
        return $this->belongsTo('App\Models\Tool\Font');
    }

    public function getUrlAttribute() {
        return 'app/custom_fonts/'.Hashids::encode($this->id).'.ttf';
    }
}

