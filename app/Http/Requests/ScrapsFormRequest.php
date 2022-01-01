<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class ScrapsFormRequest extends FormRequest
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
            'scrapreqno' => 'string|min:1|nullable',
            'scrapreqdate' => 'string|min:1|nullable',
            'scrapreqby' => 'string|min:1|nullable',
            'scrapreqstatus' => 'string|min:1|nullable',
            'scrapreqremarks' => 'string|min:1|nullable',
            'scrapissueno' => 'string|min:1|nullable',
            'scrapissuedate' => 'string|min:1|nullable',
            'scrapissueby' => 'string|min:1|nullable',
            'scrapissuestatus' => 'string|min:1|nullable',
            'scrapissueremarks' => 'string|min:1|nullable',
            'devices_id' => 'nullable',
            'devicescategory' => 'string|min:1|nullable',
            'devicesdescription' => 'string|min:1|nullable',
            'deviceserpcode' => 'string|min:1|nullable',
            'devicessizerange' => 'string|min:1|nullable',
            'clibration_source' => 'string|min:1|nullable',
            'vendorcode' => 'string|min:1|nullable',
            'vendordescription' => 'string|min:1|nullable',
            'device_smake' => 'string|min:1|nullable',
            'devices_dateofpurchase' => 'string|min:1|nullable',
            'devices_costininr' => 'string|min:1|nullable',
            'WarrantyPeriod' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable',
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
        $data = $this->only(['scrapreqno','scrapreqdate','scrapreqby','scrapreqstatus','scrapreqremarks','scrapissueno','scrapissuedate','scrapissueby','scrapissuestatus','scrapissueremarks','devices_id','devicescategory','devicesdescription','deviceserpcode','devicessizerange','clibration_source','vendorcode','vendordescription','device_smake','devices_dateofpurchase','devices_costininr','WarrantyPeriod','status','entrydate','createdby','company_id','plant_id']);

        return $data;
    }

}