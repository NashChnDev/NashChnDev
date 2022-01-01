<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CustomersFormRequest extends FormRequest
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
            'customercode' => 'string|min:1|required|unique:customers,customercode,',
            'customername' => 'string|min:1|required',
            'customeremail' => 'nullable',
            'customermobile' => 'nullable',
            'customerphone' => 'nullable',
            'customeraddress' => 'required',
            'company_country' => 'required',
            'company_state' => 'required',
            'company_city' => 'required',
            'contact_person' => 'nullable',
            'customergstinno' => 'nullable',
            'customerstatus' => 'required',
            'customerremarks' => 'nullable',
            'company_id' => 'required',
            'Customer_Types' => 'required',
    
        ];
                
            }
        else
        {
            $rules = [
            'customercode' => 'string|min:1|required',
            'customername' => 'string|min:1|required',
            'customeremail' => 'nullable',
            'customermobile' => 'nullable',
            'customerphone' => 'nullable',
            'customeraddress' => 'required',
            'company_country' => 'required',
            'company_state' => 'required',
            'company_city' => 'required',
            'contact_person' => 'nullable',
            'customergstinno' => 'nullable',
            'customerstatus' => 'required',
            'customerremarks' => 'nullable',
            'company_id' => 'required',
            'Customer_Types' => 'required',
    
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
        $data = $this->only(['customercode','customername','customeremail','customermobile','customerphone','customeraddress','company_country','company_state','company_city','contact_person','customergstinno','customerstatus','customerremarks','company_id','company_name','Customer_Types','plant_id']);

        return $data;
    }

}