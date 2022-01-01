<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ScrapreqdetailsFormRequest extends FormRequest
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
            'scrapreqno' => 'string|min:1|nullable',
            'scrapreqdate' => 'string|min:1|nullable',
            'devices_id' => 'nullable',
            'devicescategory' => 'string|min:1|nullable',
            'devicesdescription' => 'string|min:1|nullable',
            'deviceserpcode' => 'string|min:1|nullable',
            'devicessizerange' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable',
            'remarks' => 'string|min:1|nullable',
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
        $data = $this->only(['scrapreqno','scrapreqdate','devices_id','devicescategory','devicesdescription','deviceserpcode','devicessizerange','status','remarks','entrydate','createdby','company_id']);

        return $data;
    }

}