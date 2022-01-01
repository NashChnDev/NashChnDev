<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CalibrationsDetailsFormRequest extends FormRequest
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
            'calibrationreqno_id' => 'nullable',
            'calibrationreqdate' => 'string|min:1|nullable',
            'devices_id' => 'nullable',
            'devicescategory' => 'string|min:1|nullable',
            'devicesdescription' => 'string|min:1|nullable',
            'deviceserpcode' => 'string|min:1|nullable',
            'devicessizerange' => 'string|min:1|nullable',
            'quantity' => 'string|min:1|nullable',
            'clibration_source' => 'string|min:1|nullable',
            'vendorcode' => 'string|min:1|nullable',
            'vendordescription' => 'string|min:1|nullable',
            'entrydate' => 'string|min:1|nullable',
            'createdby' => 'string|min:1|nullable',
            'company_id' => 'nullable',
            'plant_id' => 'nullable',
    
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
        $data = $this->only(['calibrationreqno_id','calibrationreqdate','devices_id','devicescategory','devicesdescription','deviceserpcode','devicessizerange','quantity','clibration_source','vendorcode','vendordescription','entrydate','createdby','company_id','plant_id','device_old_status']);

        return $data;
    }

}