<?php
namespace App\Http\Requests\Warehouse;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest {
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
                        Rule::unique('locations')->where(function ($query) {
                            return $query->where('area_id', $this->input('area_id'));
                        }),
                    ],
                    'type' => 'required',
                    'area_id' => 'required',
                ];
            break;
            case 'PUT':
            case 'PATCH':
                $return = [
                    'title' => 'max:50',
                    'slug' => [
                        'required',
                        'max:50',
                        Rule::unique('locations')->where(function ($query) {
                            return $query->where('area_id', $this->input('area_id'));
                        })->ignore($this->route('area')),
                    ],
                    'area_id' => 'required',
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

