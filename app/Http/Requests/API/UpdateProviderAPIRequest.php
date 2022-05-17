<?php

namespace App\Http\Requests\API;

use App\Models\Provider;
use InfyOm\Generator\Request\APIRequest;

class UpdateProviderAPIRequest extends APIRequest
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
        $rules = Provider::$rules;
        $rules['email'] = $rules['email'].",".$this->route("provider");
        return $rules;
    }
}
