<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class area extends Model
{
//use \Staudenmeir\EloquentHasManyDeep\HasRelationships;    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'area';

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
            'departmentcode',
            'areacode',
            'areaname',
            'area_incharge',
            'status',
            'due_alert_name',
            'due_alert_email',
            'due_alert_days',
            'esclation1_alert_name',
            'esclation1_alert_email',
            'esclation1_days',
            'esclation2_alert_name',
            'esclation2_alert_email',
            'esclation2_days',
            'esclation3_alert_name',
            'esclation3_alert_email',
            'esclation3_days',
            'finalesclation_alert_name',
            'finalesclation_alert_email',
            'finalesclation_days'
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
    public function department()
    {
        return $this->hasMany('App\Models\departments','deptcode','departmentcode');
    }
    // public function items(){
    //   return $this->hasManyDeep('App\RackItem',['App\Models\RackMaster','App\Models\RackMaster'],['plant_id','parent_id','rack_id']);
    // }

    //   return $this->hasMany('App\Models\RackMaster','plant_id');
    // }

    // public function users(){
    //   return $this->hasMany('App\User','plant_id');
    // }
    
    protected static function boot()
    {
        parent::boot();
     
        if(auth()->user()->user_areas != ''){
          static::addGlobalScope('areacode', function (Builder $builder) {      
              $areacode = explode(",", auth()->user()->user_areas);
              $builder->whereIN('areacode',  $areacode);
          });
        }
       
    }
}
