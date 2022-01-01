<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class PlantsFormRequest extends FormRequest
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
            'plantcode' => 'string|min:1|required|unique:plants,plantcode,',
            'organization' => 'nullable',
            'location' => 'nullable',
            'plantname' => 'string|min:1|required',
            'plantaddress' => 'string|min:1|required',
            'plantincharge' => 'nullable',
            'plantinchargephone' => 'nullable',
            'plantinchargeemail' => 'nullable',
            'company_id' => 'required',
            'status' => 'string|min:1|required',
    
        ];
             
         }
        
        else
        {
            $rules = [
            'plantcode' => 'string|min:1|required',
            'organization' => 'nullable',
            'location' => 'nullable',
            'plantname' => 'string|min:1|required',
            'plantaddress' => 'string|min:1|required',
            'plantincharge' => 'string|min:1|nullable',
            'plantinchargephone' => 'nullable',
            'plantinchargeemail' => 'nullable',
            'company_id' => 'required',
            'status' => 'string|min:1|required',
    
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
        $data = $this->only(['plantcode','organization','location','plantname','plantaddress','company_country','company_state','company_city','plantincharge','plantinchargephone','plantinchargeemail','company_id','company_name','status']);

        return $data;
    }

}