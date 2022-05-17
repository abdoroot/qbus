<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\User;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = User::$update_rules;
        foreach($rules as $i => $r) {
            foreach($r as $k => $rule) {
                if(strpos($rule, 'unique') !== false) {
                    $r[$k] .= "," . $this->user;
                    $rules[$i] = $r;
                }
            }
        }
        return $rules;
    }
}
