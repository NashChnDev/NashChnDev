<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ProductionLinesFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'linedescription' => 'string|min:1|nullable',
            'plant_id' => 'nullable',
            'lineincharge' => 'string|min:1|nullable',
            'lineemailid' => 'nullable',
            'linestatus' => 'string|min:1|nullable',
    
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
        $data = $this->only(['linedescription','plant_id','lineincharge','lineemailid','linestatus']);

        return $data;
    }

}