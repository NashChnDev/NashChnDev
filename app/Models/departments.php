<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
class departments extends Model
{
//use \Staudenmeir\EloquentHasManyDeep\HasRelationships;    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'departments';

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
                  'deptname',
                  'plant_id',
                  'deptcode',
                  'deptphone',
                  'deptincharge',
                  'deptstatus'                 
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


    protected static function boot()
    {
        parent::boot();
     
        if(auth()->user()->user_departs != ''){
          static::addGlobalScope('deptcode', function (Builder $builder) {      
              $deptcode = explode(",", auth()->user()->user_departs);
              $builder->whereIN('deptcode',  $deptcode);
          });
        }
       
    }
    
    /**
     * Get the company for this model.
     */
    // public function company()
    // {
    //     return $this->belongsTo('App\Models\Company','company_id');
    // }
    // public function items(){
    //   return $this->hasManyDeep('App\RackItem',['App\Models\RackMaster','App\Models\RackMaster'],['plant_id','parent_id','rack_id']);
    // }

    // public function racks(){
    //   return $this->hasMany('App\Models\RackMaster','plant_id');
    // }

    // public function users(){
    //   return $this->hasMany('App\User','plant_id');
    // }
    
    
}
