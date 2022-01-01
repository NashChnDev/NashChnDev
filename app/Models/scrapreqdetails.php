<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class scrapreqdetails extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'scrapreqdetails';

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
                  'devices_id',
                  'devicescategory',
                  'devicesdescription',
                  'deviceserpcode',
                  'devicessizerange',
                  'status',
                  'remarks',
                  'entrydate',
                  'createdby',
                  'company_id'
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
     * Get the company for this model.
     */
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }



}
