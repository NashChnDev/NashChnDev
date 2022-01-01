<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class calibrations_details extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'calibrations_details';

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
                  'calibrationreqno_id',
                  'calibrationreqdate',
                  'devices_id',
                  'devicescategory',
                  'devicesdescription',
                  'deviceserpcode',
                  'devicessizerange',
                  'quantity',
                  'clibration_source',
                  'vendorcode',
                  'vendordescription',
                  'entrydate',
                  'createdby',
                  'company_id',
                  'plant_id',
        
                  'grnno',
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
                  'billingremarks',
                  'reportattachment',
                'device_old_status'
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
     * Get the calibrationreqno for this model.
     */
    public function calibrationreqno()
    {
        return $this->belongsTo('App\Models\Calibrationreqno','calibrationreqno_id');
    }

    /**
     * Get the device for this model.
     */
    public function device()
    {
        return $this->belongsTo('App\Models\Device','devices_id');
    }

    /**
     * Get the company for this model.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }

    /**
     * Get the plant for this model.
     */
    public function plant()
    {
        return $this->belongsTo('App\Models\Plant','plant_id');
    }



}
