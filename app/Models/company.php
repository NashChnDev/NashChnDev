<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class company extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'companies';

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
                  'company_code',
                  'company_name',
                  'company_address',
                  'company_country',
                  'company_state',
                  'company_city',
                  'company_email',
                  'company_phone',
                  'company_mobile',
                  'company_website',
                  'company_gstinno',
                  'company_logo',
                  'company_status'
              ];
    protected $appends=['country_text'];
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
    
    public function country()
    {
        return $this->belongsTo('App\Models\Country','company_country');
    }
    
    public function getCountryTextAttribute()
    {
        return $this->country->name;
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
    
    
    public function plants()
    {
      return $this->hasMany('App\Models\Plants','company_id','company_code');
    }



}
