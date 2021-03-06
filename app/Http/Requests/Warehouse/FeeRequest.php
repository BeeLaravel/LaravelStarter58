<?php
namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

class FeeRequest extends FormRequest {
    public function authorize() {
        return true;
    }
    public function rules() {
        switch ( $this->method() ) {
            case 'POST':
                $return = [
                    'slug' => [
                        'required',
                        'max:50',
                    ],
                    'type' => 'required',
                ];
            break;
            case 'PUT':
            case 'PATCH':
                $return = [
                    'slug' => [
                        'required',
                        'max:50',
                    ],
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
