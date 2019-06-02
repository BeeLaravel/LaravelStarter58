<?php
namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class AreaRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    public function rules() {
        switch ( $this->method() ) {
            case 'POST':
                $return = [
                    'title' => 'required|max:50',
                    'slug' => [
                        'required',
                        'max:50',
                        Rule::unique('areas')->where(function ($query) {
                            return $query->where('warehouse_id', $this->input('warehouse_id'));
                        }),
                    ],
                    'type' => 'required',
                    'warehouse_id' => 'required',
                ];
            break;
            case 'PUT':
            case 'PATCH':
                $return = [
                    'title' => 'max:50',
                    'slug' => [
                        'required',
                        'max:50',
                        Rule::unique('areas')->where(function ($query) {
                            return $query->where('warehouse_id', $this->input('warehouse_id'));
                        })->ignore($this->route('area')),
                    ],
                    'warehouse_id' => 'required',
                ];
            break;
            default:
                $return = [];
        }

        // $return = array_merge($return, [
        // ]);

        return $return;
    }
}
