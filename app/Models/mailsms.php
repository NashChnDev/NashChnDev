<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class mailsms extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'mailsms';

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
                  'fieldsname',
                  'optionvalue',
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
    
    public function devices_description()
    {
      return $this->hasMany('App\Models\devices','devices_description','optionvalue');
    }
    
    public function devices_type()
    {
      return $this->hasMany('App\Models\devices','device_VariableType','optionvalue');
    }
    
    public function customer_type()
    {
      return $this->hasMany('App\Models\customer','Customer_Types','optionvalue');
    }
    
    public function vendor_type()
    {
      return $this->hasMany('App\Models\Vendors','vendortypes','optionvalue');
    }


}
