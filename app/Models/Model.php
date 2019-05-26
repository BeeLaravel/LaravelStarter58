<?php
namespace App\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

class Model extends \Illuminate\Database\Eloquent\Model {
    use SoftDeletes;

    public function visits() {
        return visits($this);
    }
}

