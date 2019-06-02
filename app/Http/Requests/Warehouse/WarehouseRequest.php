<?php
namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class WarehouseRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    public function rules() {
        switch ( $this->method() ) {
            case 'POST':
                $return = [
                    'slug' => 'required|unique:warehouses|max:50',
                    'title' => 'required|max:50',
                    'type' => 'required',
                ];
            break;
            case 'PUT':
            case 'PATCH':
                $return = [
                    'slug' => 'unique:warehouses,slug,'.$this->route('warehouse').'|max:50',
                    'title' => 'max:50',
                ];
            break;
            default:
                $return = [];
        }

        return $return;
    }
}

