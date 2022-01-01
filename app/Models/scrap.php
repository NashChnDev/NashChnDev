<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class scrap extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scraps';

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
                  'scrapreqno',
                  'scrapreqdate',
                  'scrapreqby',
                  'scrapreqstatus',
                  'scrapreqremarks',
                  'scrapissueno',
                  'scrapissuedate',
                  'scrapissueby',
                  'scrapissuestatus',
                  'scrapissueremarks',
                  'devices_id',
                  'devicescategory',
                  'devicesdescription',
                  'deviceserpcode',
                  'devicessizerange',
                  'clibration_source',
                  'vendorcode',
                  'vendordescription',
                  'device_smake',
                  'devices_dateofpurchase',
                  'devices_costininr',
                  'WarrantyPeriod',
                  'status',
                  'entrydate',
                  'createdby',
                  'company_id',
'rejectedremarks',
'rejectedentryby',
'rejecteddate',
'rejectedby',
'acceptremarks',
'acceptentryby',
'acceptdate',
'acceptby',
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
        return $this->belongsTo('App\Models\devices','devices_id');
    }

    /**
     * Get the company for this model.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }



}
