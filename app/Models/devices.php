<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class devices extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'devices';

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
    protected $appends=['alert_date'];
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
                  'company_id',
                  'company_name',
                  'createdby',
                  'expirydate',
                  'alert_remaindate',
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
'WARRANTYCARD','device_NorIN','plant_id'
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
     * Get the vendor for this model.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Models\Vendors','vendors_id');
    }

    /**
     * Get the customer for this model.
     */
    public function customer()
    {
        return $this->belongsTo('App\Models\Customer','customer_id');
    }

    /**
     * Get the optionvalue for this model.
     */
    public function optionvalue()
    {
        return $this->belongsTo('App\Models\DropDowns','devices_CalibrationResult');
    }

    /**
     * Get the company for this model.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    
    public function getAlertDateAttribute(){
        $expiry_date=Carbon::createFromFormat('Y-m-d', $this->attributes['expirydate']);
        return $expiry_date->endOfDay()->subDays($this->attributes['devices_alerydays']-1)->startOfDay()->format('Y-m-d');
    }
    
    public function deviceINreq()
    {
      return $this->hasMany('App\Models\gaugerequestdetail','devices_id','devices_id');
    }
    
    public function deviceINissue()
    {
      return $this->hasMany('App\Models\gaugeissuedetails','devices_id','devices_id');
    }
    
    public function deviceINcalibrate()
    {
      return $this->hasMany('App\Models\calibrations_details','devices_id','devices_id');
    }
    
    public function deviceINscrapReq()
    {
      return $this->hasMany('App\Models\scrap','devices_id','devices_id');
    }
    
    
     public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    
    


}
