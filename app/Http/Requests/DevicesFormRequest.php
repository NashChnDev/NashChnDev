<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;


class DevicesFormRequest extends FormRequest
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
            'devices_id' => 'string|required|unique:devices,devices_id,',
            'devices_description' => 'string|min:1|required',
            'device_scategory' => 'string|min:1|required',
            'device_sasseterpcode' => 'string|min:1|nullable',
            'devices_sizerange' => 'string|min:1|nullable',
            'device_smake' => 'string|min:1|required',
            'devices_units' => 'string|min:1|nullable',
            'devices_property' => 'string|min:1|nullable',
            'devices_storgelocation' => 'string|min:1|nullable',
            'devices_range' => 'nullable',
            'devices_leastcount' => 'nullable',
            'devices_accuracy' => 'string|min:1|nullable',
            'devices_acceptancecriteria' => 'string|min:1|nullable',
            'devices_frequencyofCalibration' => 'string|min:1|nullable',
            'devices_frequencyofCalibration_duration' => 'nullable',
            'devices_alerydays' => 'nullable',
            'vendors_id' => 'required',
            'devices_dateofpurchase' => 'nullable',
            'lastcalibrationdate' => 'nullable',
            'devices_costininr' => 'nullable',
            'customer_id' => 'nullable',
            'devices_project' => 'string|min:1|nullable',
            'devices_part' => 'string|min:1|nullable',
            'devices_operation' => 'string|min:1|nullable',
            'devices_certificatereceived' => 'nullable',
            'devices_certificateno' => 'nullable',
            'devices_certificateupload' => ['min:1','nullable','file'],
            'devices_method' => 'string|min:1|nullable',
            'devices_CalibratedBy' => 'string|min:1|nullable',
            'devices_CalibratedOn' => 'nullable',
            'devices_CheckedBy' => 'string|min:1|nullable',
            'devices_ApprovedBY' => 'string|min:1|nullable',
            'devices_ApprovedOn' => 'nullable',
            'devices_CalibrationResult' => 'string|min:1|nullable',
            'devices_Treacibility' => 'string|min:1|nullable',
            'company_id' => 'nullable',
            'createdby' => 'string|min:1|nullable',
            'expirydate' => 'required',
            'lastcalibrationdate' => 'nullable',
            
    
        ];
             }
        else
        {
             $rules = [
            'devices_id' => 'string|required',
            'devices_description' => 'string|required',
            'device_scategory' => 'string|required',
            'device_sasseterpcode' => 'string|nullable',
            'devices_sizerange' => 'string|nullable',
            'device_smake' => 'string|required',
            'devices_units' => 'string|nullable',
            'devices_property' => 'string|nullable',
            'devices_storgelocation' => 'string|nullable',
            'devices_range' => 'string|min:1|nullable',
            'devices_leastcount' => 'nullable|',
            'devices_accuracy' => 'string|min:1|nullable',
            'devices_acceptancecriteria' => 'string|min:1|nullable',
            'devices_frequencyofCalibration' => 'string|min:1|nullable',
            'devices_frequencyofCalibration_duration' => 'string|min:1|nullable',
            'devices_alerydays' => 'string|min:1|nullable',
            'vendors_id' => 'required',
            'devices_dateofpurchase' => 'nullable',
            'lastcalibrationdate' => 'nullable',
            'devices_costininr' => 'string|min:1|nullable',
            'customer_id' => 'nullable',
            'devices_project' => 'string|min:1|nullable',
            'devices_part' => 'string|min:1|nullable',
            'devices_operation' => 'string|min:1|nullable',
            'devices_certificatereceived' => 'nullable',
            'devices_certificateno' => 'nullable',
            'devices_certificateupload' => ['min:1','nullable','file'],
            'devices_method' => 'string|min:1|nullable',
            'devices_CalibratedBy' => 'string|min:1|nullable',
            'devices_CalibratedOn' => 'nullable',
            'devices_CheckedBy' => 'string|min:1|nullable',
            'devices_ApprovedBY' => 'string|min:1|nullable',
            'devices_ApprovedOn' => 'nullable',
            'devices_CalibrationResult' => 'string|min:1|nullable',
            'devices_Treacibility' => 'string|min:1|nullable',
            'company_id' => 'nullable',
            'createdby' => 'string|min:1|nullable',
            'expirydate' => 'required',
            'lastcalibrationdate' => 'nullable',
    
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
        $data = $this->only(['devices_id','devices_description','device_scategory','device_sasseterpcode','devices_sizerange','device_smake','devices_units','devices_property','devices_storgelocation','devices_range','devices_leastcount','devices_accuracy','devices_acceptancecriteria','devices_frequencyofCalibration','devices_frequencyofCalibration_duration','devices_alerydays','vendors_id','devices_dateofpurchase','expirydate','devices_costininr','customer_id','devices_project','devices_part','devices_operation','devices_certificatereceived','devices_certificateno','devices_method','devices_CalibratedBy','devices_CalibratedOn','devices_CheckedBy','devices_ApprovedBY','devices_ApprovedOn','devices_CalibrationResult','devices_Treacibility','company_id','company_name','createdby','lastcalibrationdate','status','alert_remaindate',
'device_VariableType',
'device_MechanismType',
'Capacity',
'clibration_source',
'WarrantyPeriod',
'AMCRequired',
'WHOSource',
'CostofAMC',
'PurchaseBill',
'WARRANTYCARD','device_NorIN','plant_id']);
        if ($this->has('custom_delete_devices_certificateupload')) {
            $data['devices_certificateupload'] = null;
        }
        if ($this->hasFile('devices_certificateupload')) {
            $data['devices_certificateupload'] = $this->moveFile($this->file('devices_certificateupload'));
        }
        
        if ($this->has('custom_delete_PurchaseBill')) {
            $data['PurchaseBill'] = null;
        }
        if ($this->hasFile('PurchaseBill')) {
            $data['PurchaseBill'] = $this->moveFile($this->file('PurchaseBill'));
        }
        
        if ($this->has('custom_delete_WARRANTYCARD')) {
            $data['WARRANTYCARD'] = null;
        }
        if ($this->hasFile('WARRANTYCARD')) {
            $data['WARRANTYCARD'] = $this->moveFile($this->file('WARRANTYCARD'));
        }


        return $data;
    }
  
    /**
     * Moves the attached file to the server.
     *
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $file
     *
     * @return string
     */
    protected function moveFile($file)
    {
        if (!$file->isValid()) {
            return '';
        }
        
        $path = config('codegenerator.files_upload_path', 'uploads');
        $saved = $file->store('public/' . $path, config('filesystems.default'));

        return substr($saved, 7);
    }
}