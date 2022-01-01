<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class CalibrationsFormRequest extends FormRequest
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
            'calibrationreqno' => 'string|min:1|nullable',
            'calibrationreqdate' => 'string|min:1|nullable',
            'calibrationreqby' => 'string|min:1|nullable',
            'calibrationreqstatus' => 'string|min:1|nullable',
            'calibrationreqremarks' => 'string|min:1|nullable',
            'calibrationissueno' => 'string|min:1|nullable',
            'calibrationissuedate' => 'string|min:1|nullable',
            'calibrationissueby' => 'string|min:1|nullable',
            'calibrationissuestatus' => 'string|min:1|nullable',
            'calibrationissueremarks' => 'string|min:1|nullable',
            /*'devices_id' => 'nullable',
            'devicescategory' => 'string|min:1|nullable',
            'devicesdescription' => 'string|min:1|nullable',
            'deviceserpcode' => 'string|min:1|nullable',
            'devicessizerange' => 'string|min:1|nullable',
            'quantity' => 'string|min:1|nullable',
            'clibration_source' => 'string|min:1|nullable',
            'vendorcode' => 'string|min:1|nullable',
            'vendordescription' => 'string|min:1|nullable',*/
            'providedfor' => 'string|min:1|nullable',
            'dcno' => 'string|min:1|nullable',
            'dcdate' => 'string|min:1|nullable',
            'dcentryby' => 'string|min:1|nullable',
            'dcremarks' => 'string|min:1|nullable',
            'grnno' => 'string|min:1|nullable',
            'grndate' => 'string|min:1|nullable',
            'invoiceno' => 'string|min:1|nullable',
            'invoicedate' => 'string|min:1|nullable',
            'refno' => 'string|min:1|nullable',
            'receiptno' => 'string|min:1|nullable',
            'receiptdate' => 'string|min:1|nullable',
            'receiptentryby' => 'string|min:1|nullable',
            'calibratedon' => 'string|min:1|nullable',
            'calibratedby' => 'string|min:1|nullable',
            'calibratedresult' => 'string|min:1|nullable',
            'calibratedcertificate' => 'string|min:1|nullable',
            'pono' => 'string|min:1|nullable',
            'podate' => 'string|min:1|nullable',
            'servicesheet' => 'string|min:1|nullable',
            'billingno' => 'string|min:1|nullable',
            'billingdate' => 'string|min:1|nullable',
            'billingremarks' => 'string|min:1|nullable',
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
        $data = $this->only(['calibrationreqno','calibrationreqdate','calibrationreqby','calibrationreqstatus','calibrationreqremarks','calibrationissueno','calibrationissuedate','calibrationissueby','calibrationissuestatus','calibrationissueremarks','devices_id','devicescategory','devicesdescription','deviceserpcode','devicessizerange','quantity','clibration_source','vendorcode','vendordescription','providedfor','dcno','dcdate','dcentryby','dcremarks','grnno','grndate','invoiceno','invoicedate','refno','receiptno','receiptdate','receiptentryby','calibratedon','calibratedby','calibratedresult','calibratedcertificate','pono','podate','servicesheet','billingno','billingdate','billingremarks','status','entrydate','createdby','company_id','plant_id','issed',
                            
                     'vendorcode_id','vendordescription_id',
                    'calibrate_to',     
                    'calibrationreqno_id',
                    ]);

        return $data;
    }

}