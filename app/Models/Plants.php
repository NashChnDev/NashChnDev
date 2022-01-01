<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class plants extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'plants';

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
                  'plantcode',
                  'organization',
                  'location',
                  'plantname',
                  'plantaddress',
                  'plantincharge',
                  'plantinchargephone',
                  'plantinchargeemail',
                  'company_id',
                  'company_name',
                  'status',
            'company_country','company_state','company_city',
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
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    
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
    
    public function departments()
    {
      return $this->hasMany('App\Models\departments','plant_id','plantcode');
    }
    
  
    
        




}
