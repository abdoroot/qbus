<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Additional;

class UpdateAdditionalRequest extends FormRequest
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
        $rules = Additional::$update_rules;
        
        foreach($rules as $i => $rule) {
            if(strpos($rule, 'unique') !== false) {
                $rules[$i] .= "," . $this->additional;
            }
        }
        return $rules;
    }
}
