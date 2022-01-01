<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class customer extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'customers';

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
                  'customercode',
                  'customername',
                  'customeremail',
                  'customermobile',
                  'customerphone',
                  'customeraddress',
                  'company_country',
                  'company_state',
                  'company_city',
                  'contact_person',
                  'customergstinno',
                  'customerstatus',
                  'customerremarks',
                  'company_id',
                  'company_name',
                  'Customer_Types',
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
     * Get the company for this model.
     */
       public function optionvalue()
    {
        return $this->belongsTo('App\Models\DropDowns','Customer_Types');
    }

    
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    
     public function country()
    {
        return $this->belongsTo('App\Models\Country','company_country');
    }
    
    /**
     * Get the state for this model.
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State','company_state');
    }

    /**
     * Get the city for this model.
     */
    public function city()
    {
        return $this->belongsTo('App\Models\City','company_city');
    }
    
      public function deviceMaster()
    {
      return $this->hasMany('App\Models\devices','customer_id');
    }




}
