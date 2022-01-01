<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class HistorycardsFormRequest extends FormRequest
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
            'devices_id' => 'nullable',
            'devices_description' => 'string|min:1|nullable',
            'device_scategory' => 'string|min:1|nullable',
            'device_sasseterpcode' => 'string|min:1|nullable',
            'devices_sizerange' => 'string|min:1|nullable',
            'device_smake' => 'string|min:1|nullable',
            'devices_units' => 'string|min:1|nullable',
            'devices_property' => 'string|min:1|nullable',
            'devices_storgelocation' => 'string|min:1|nullable',
            'devices_range' => 'string|min:1|nullable',
            'devices_leastcount' => 'numeric|nullable',
            'devices_accuracy' => 'string|min:1|nullable',
            'devices_acceptancecriteria' => 'string|min:1|nullable',
            'devices_frequencyofCalibration' => 'string|min:1|nullable',
            'devices_frequencyofCalibration_duration' => 'string|min:1|nullable',
            'devices_alerydays' => 'string|min:1|nullable',
            'vendors_id' => 'nullable',
            'devices_dateofpurchase' => 'string|min:1|nullable',
            'lastcalibrationdate' => 'string|min:1|nullable',
            'devices_costininr' => 'string|min:1|nullable',
            'customer_id' => 'nullable',
            'devices_project' => 'string|min:1|nullable',
            'devices_part' => 'string|min:1|nullable',
            'devices_operation' => 'string|min:1|nullable',
            'devices_certificatereceived' => 'string|min:1|nullable',
            'devices_certificateno' => 'string|min:1|nullable',
            'devices_certificateupload' => 'string|min:1|nullable',
            'devices_method' => 'string|min:1|nullable',
            'devices_CalibratedBy' => 'string|min:1|nullable',
            'devices_CalibratedOn' => 'string|min:1|nullable',
            'devices_CheckedBy' => 'string|min:1|nullable',
            'devices_ApprovedBY' => 'string|min:1|nullable',
            'devices_ApprovedOn' => 'string|min:1|nullable',
            'devices_CalibrationResult' => 'string|min:1|nullable',
            'devices_Treacibility' => 'string|min:1|nullable',
            'status' => 'string|min:1|nullable',
            'device_VariableType' => 'string|min:1|nullable',
            'device_MechanismType' => 'string|min:1|nullable',
            'Capacity' => 'string|min:1|nullable',
            'clibration_source' => 'string|min:1|nullable',
            'WarrantyPeriod' => 'string|min:1|nullable',
            'AMCRequired' => 'string|min:1|nullable',
            'WHOSource' => 'string|min:1|nullable',
            'CostofAMC' => 'string|min:1|nullable',
            'PurchaseBill' => 'string|min:1|nullable',
            'WARRANTYCARD' => 'string|min:1|nullable',
           // 'device_NorINcalibrationreqno' => 'string|min:1|nullable',
            'calibrationreqdate' => 'string|min:1|nullable',
            'calibrationreqby' => 'string|min:1|nullable',
            'calibrationissueno' => 'string|min:1|nullable',
            'calibrationissuedate' => 'string|min:1|nullable',
            'calibrationissueby' => 'string|min:1|nullable',
            'calibratedon' => 'string|min:1|nullable',
            'calibratedby' => 'string|min:1|nullable',
            'calibratedresult' => 'string|min:1|nullable',
            'calibratedcertificate' => 'string|min:1|nullable',
            'complete_status' => 'string|min:1|nullable',
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
        $data = $this->only(['devices_id','devices_description','device_scategory','device_sasseterpcode','devices_sizerange','device_smake','devices_units','devices_property','devices_storgelocation','devices_range','devices_leastcount','devices_accuracy','devices_acceptancecriteria','devices_frequencyofCalibration','devices_frequencyofCalibration_duration','devices_alerydays','vendors_id','devices_dateofpurchase','lastcalibrationdate','devices_costininr','customer_id','devices_project','devices_part','devices_operation','devices_certificatereceived','devices_certificateno','devices_certificateupload','devices_method','devices_CalibratedBy','devices_CalibratedOn','devices_CheckedBy','devices_ApprovedBY','devices_ApprovedOn','devices_CalibrationResult','devices_Treacibility','status','device_VariableType','device_MechanismType','Capacity','clibration_source','WarrantyPeriod','AMCRequired','WHOSource','CostofAMC','PurchaseBill','WARRANTYCARD','device_NorIN','calibrationreqno','calibrationreqdate','calibrationreqby','calibrationissueno','calibrationissuedate','calibrationissueby','calibratedon','calibratedby','calibratedresult','calibratedcertificate','complete_status','entrydate','createdby','company_id','plant_id']);

        return $data;
    }

}