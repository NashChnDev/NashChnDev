<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class VendorsFormRequest extends FormRequest
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
            'vendorcode' => 'string|min:1|required|unique:vendors,vendorcode,',
            'vendortypes' => 'string|min:1|required',
            'vendorname' => 'string|min:1|required',
            'contactperson' => 'nullable',
            'phoneno' => 'nullable',
            'landlineno' => 'nullable',
            'emailid' => 'nullable',
            'address' => 'required',
            'vendorgstino' => 'nullable',
            'vendorlocation' => 'nullable',
            'vendorstatus' => 'required',
            'company_country' => 'string|required',
            'company_state' => 'string|min:1|required',
            'company_city' => 'string|min:1|required',
            'vendorrRemarks' => 'nullable',
            'company_id' => 'required',
    
        ];
            }
        else
        {
             $rules = [
            'vendorcode' => 'string|min:1|required',
            'vendortypes' => 'string|min:1|nullable',
            'vendorname' => 'string|min:1|required',
            'contactperson' => 'nullable',
            'phoneno' => 'nullable',
            'landlineno' => 'nullable',
            'emailid' => 'nullable',
            'address' => 'required',
            'vendorgstino' => 'nullable',
            'vendorlocation' => 'nullable',
            'vendorstatus' => 'required',
            'company_country' => 'string|required',
            'company_state' => 'string|min:1|required',
            'company_city' => 'string|min:1|required',
            'vendorrRemarks' => 'string|min:1|nullable',
            'company_id' => 'required',
    
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
        $data = $this->only(['vendorcode','vendortypes','vendorname','contactperson','phoneno','landlineno','emailid','address','vendorgstino','vendorlocation','vendorstatus','company_country','company_state','company_city','vendorrRemarks','company_id','company_name','plant_id']);

        return $data;
    }

}