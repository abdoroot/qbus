<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Service;

class UpdateServiceRequest extends FormRequest
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
        $rules = Service::$update_rules;
        
        foreach($rules as $i => $rule) {
            if(strpos($rule, 'unique') !== false) {
                $rules[$i] .= "," . $this->service;
            }
        }
        return $rules;
    }
}
