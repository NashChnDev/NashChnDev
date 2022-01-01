<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class mailsmsFormRequest extends FormRequest
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
         if($this->method() == 'POST')
        {
             $rules = [
            'fieldsname' => 'nullable',
            'optionvalue' => 'required|unique:drop_downs,optionvalue',
    
        ]; 
         }
        else{
             $rules = [
            'fieldsname' => 'nullable',
            'optionvalue' => 'required',
    
        ];
        }
       

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
        $data = $this->only(['fieldsname','optionvalue','plant_id']);

        return $data;
    }

}