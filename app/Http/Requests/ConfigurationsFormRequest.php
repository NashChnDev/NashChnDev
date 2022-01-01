<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ConfigurationsFormRequest extends FormRequest
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
        $rules = [
            'key' => 'string|min:1|nullable',
            'reqprefix' => 'string|min:1|nullable',
            'reqsuffix' => 'string|min:1|nullable',
            'is_active' => 'boolean|nullable',
            'keyvalue' => 'string|min:1|nullable',
            'entrydate' => 'string|min:1|nullable',
            'createdby' => 'string|min:1|nullable',
            'company_id' => 'nullable',
    
        ];

        return $rules;
    }
    
    /**
     * Get the request's data from the request.
     *
     * 
     * @return array
     */
    public function getData()
    {
        $data = $this->only(['key','reqprefix','reqsuffix','is_active','keyvalue','entrydate','createdby','company_id']);
        $data['is_active'] = $this->has('is_active');

        return $data;
    }

}