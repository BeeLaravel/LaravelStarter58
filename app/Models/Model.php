<?php
namespace App\Models;

class Model extends \Illuminate\Database\Eloquent\Model {
    public function visits() {
        return visits($this);
    }
}

