<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DropDowns extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'drop_downs';

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
                  'plant_id',
                  'equal_value'
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
    
    public function devices_catagory()
    {
      return $this->hasMany('App\Models\devices','device_scategory','optionvalue');
    }
    
    public function devices_description()
    {
      return $this->hasMany('App\Models\devices','devices_description','optionvalue');
    }
    
    public function devices_type()
    {
      return $this->hasMany('App\Models\devices','device_VariableType','optionvalue');
    }
    
     public function devices_property()
    {
      return $this->hasMany('App\Models\devices','devices_property','optionvalue');
    }
    
     public function devices_mechanism()
    {
      return $this->hasMany('App\Models\devices','device_MechanismType','optionvalue');
    }
    
     public function usage_location()
    {
      return $this->hasMany('App\Models\devices','devices_storgelocation','optionvalue');
    }
    
     public function gauge_statuses()
    {
      return $this->hasMany('App\Models\devices','devices_CalibrationResult','optionvalue');
    }
    
    
    
    
    public function customer_type()
    {
      return $this->hasMany('App\Models\customer','Customer_Types','optionvalue');
    }
    
    public function vendor_type()
    {
      return $this->hasMany('App\Models\Vendors','vendortypes','optionvalue');
    }
    
    public function request_reason()
    {
      return $this->hasMany('App\Models\gaugerequestheader','gaugereqreason','optionvalue');
    }
    
    
    


}
