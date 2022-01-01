<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ShiftsFormRequest extends FormRequest
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
            'shiftcode' => 'required|unique:shifts,shiftcode',
            'shiftname' => 'required',
            'shiftincharge' => 'nullable',
            'shiftstarttime' => 'nullable',
            'shiftendtime' => 'nullable',
            'createdby' => 'nullable',
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
        $data = $this->only(['shiftcode','shiftname','shiftincharge','shiftstarttime','shiftendtime','createdby','company_id','plant_id']);

        return $data;
    }

}