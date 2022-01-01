<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employees';

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
                  'empcode',
                  'empname',
                  'department_id',
                  'empemail',
                  'empmobile',
                  'empaddress',
                  'company_country',
                  'company_state',
                  'company_city',
                  'empplace',
                  'empphoto',
                  'empstatus',
                  'empremarks',
                    'deptname',
                    'deptdescription',
                    'plant_id',
                    'company_id',
                    'company_name',
                    'createdby',
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
     * Get the department for this model.
     */
    public function department()
    {
        return $this->belongsTo('App\Models\Departments','department_id');
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
    
     public function userTable()
    {
      return $this->hasMany('App\User','name','empcode');
    }



}
