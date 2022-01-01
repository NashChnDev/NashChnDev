<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;

class DropDownsFormRequest extends FormRequest
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
    public function rules(Request $request)
    {
         if($this->method() == 'POST')
        {
             $rules = [
            'fieldsname'  => 'nullable',
            'optionvalue' => ['required',Rule::unique('drop_downs')->where(function ($query) use ($request) {
              return $query->where('optionvalue', $request->optionvalue)->where('fieldsname', $request->fieldsname);
                    })],
                    'equal_value'=> 'nullable'
            //'optionvalue' => 'required|unique:drop_downs,optionvalue',
    
        ]; 
         }
        else{
             $rules = [
            'fieldsname' => 'nullable',
            'optionvalue' => 'required',
            'equal_value' => 'nullable'
    
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
        $data = $this->only(['fieldsname','optionvalue','plant_id','equal_value']);

        return $data;
    }

}