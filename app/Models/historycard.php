<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class historycard extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'historycards';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    /**
     * Attributes that should be mass-assignable.
     *
     * @var array
     */
    protected $fillable = [
                  'devices_id',
                  'devices_description',
                  'device_scategory',
                  'device_sasseterpcode',
                  'devices_sizerange',
                  'device_smake',
                  'devices_units',
                  'devices_property',
                  'devices_storgelocation',
                  'devices_range',
                  'devices_leastcount',
                  'devices_accuracy',
                  'devices_acceptancecriteria',
                  'devices_frequencyofCalibration',
                  'devices_frequencyofCalibration_duration',
                  'devices_alerydays',
                  'vendors_id',
                  'devices_dateofpurchase',
                  'lastcalibrationdate',
                  'devices_costininr',
                  'customer_id',
                  'devices_project',
                  'devices_part',
                  'devices_operation',
                  'devices_certificatereceived',
                  'devices_certificateno',
                  'devices_certificateupload',
                  'devices_method',
                  'devices_CalibratedBy',
                  'devices_CalibratedOn',
                  'devices_CheckedBy',
                  'devices_ApprovedBY',
                  'devices_ApprovedOn',
                  'devices_CalibrationResult',
                  'devices_Treacibility',
                  'status',
                  'device_VariableType',
                  'device_MechanismType',
                  'Capacity',
                  'clibration_source',
                  'WarrantyPeriod',
                  'AMCRequired',
                  'WHOSource',
                  'CostofAMC',
                  'PurchaseBill',
                  'WARRANTYCARD',
                  'device_NorIN',
                  'calibrationreqno',
                  'calibrationreqdate',
                  'calibrationreqby',
                  'calibrationissueno',
                  'calibrationissuedate',
                  'calibrationissueby',
                  'calibratedon',
                  'calibratedby',
                  'calibratedresult',
                  'calibratedcertificate',
                  'complete_status',
                  'entrydate',
                  'createdby',
                  'company_id',
                  'plant_id'
              ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [];
    
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];
    
    /**
     * Get the device for this model.
     */
    public function device()
    {
        return $this->belongsTo('App\Models\Device','devices_id');
    }

    /**
     * Get the vendor for this model.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendor','vendors_id');
    }

    /**
     * Get the customer for this model.
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }

    /**
     * Get the company for this model.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }



}
