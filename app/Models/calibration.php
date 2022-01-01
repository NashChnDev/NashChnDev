<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class calibration extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calibrations';

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
                  'calibrationreqno',
                  'calibrationreqdate',
                  'calibrationreqby',
                  'calibrationreqstatus',
                  'calibrationreqremarks',
                  'calibrationissueno',
                  'calibrationissuedate',
                  'calibrationissueby',
                  'calibrationissuestatus',
                  'calibrationissueremarks',
                  /*'devices_id',
                  'devicescategory',
                  'devicesdescription',
                  'deviceserpcode',
                  'devicessizerange',
                  'quantity',
                  'clibration_source',*/
                  'calibrate_to',
                  'vendorcode_id',
                  'vendordescription_id',
                  'providedfor',
                  'dcno',
                  'dcdate',
                  'dcentryby',
                  'dcremarks',
                  /*'grnno',
                  'grndate',
                  'grnremarks',
                  'invoiceno',
                  'invoicedate',
                  'refno',
                  'receiptno',
                  'receiptdate',
                  'receiptentryby',
                  'calibratedon',
                  'calibratedby',
                  'calibratedresult',
                  'calibratedcertificate',
                  'pono',
                  'podate',
                  'servicesheet',
                  'billingno',
                  'billingdate',
                  'billingremarks','reportattachment',*/
                  'status',
                  'entrydate',
                  'createdby',
                  'company_id',
                  'created_at',
                    'issed','plant_id'
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
        return $this->belongsTo('App\Models\devices','devices_id');
    }
    
     public function devicelist()
    {
       return $this->hasMany('App\Models\calibrations_details','calibrationreqno_id','calibrationreqno');
    }
    
     public function readyforbill()
    {
       return $this->hasMany('App\Models\calibrations_details','calibrationreqno_id','calibrationreqno')->where('status',2);
    }
    
    public function readyforreceipt()
    {
       return $this->hasMany('App\Models\calibrations_details','calibrationreqno_id','calibrationreqno')->where('status',0);
    }
    
   
    
    
    
    /**
     * Get the company for this model.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }



}
