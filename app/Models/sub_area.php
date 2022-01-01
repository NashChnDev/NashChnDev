<?php

namespace App\Models;;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class sub_area extends Model
{
    protected $table = 'sub_area';

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
            'subareacode',
            'subareaname',
            'subareaincharge',
            'status'
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

            public function area()
             {
                 return $this->hasMany('App\Models\area','areacode','areacode');
             }
            protected static function boot()
            {
                parent::boot();
            
                if(auth()->user()->user_plants != ''){
                static::addGlobalScope('plantcode', function (Builder $builder) {      
                    $plantcode = explode(",", auth()->user()->user_plants);
                    $builder->whereIN('plantcode',  $plantcode);
                });
                }
                if(auth()->user()->user_departs != ''){
                    static::addGlobalScope('department', function (Builder $builder) {      
                        $deptcode = explode(",", auth()->user()->user_departs);
                        $builder->whereIN('department',  $deptcode);
                    });
                }
                if(auth()->user()->user_areas != ''){
                    static::addGlobalScope('area', function (Builder $builder) {      
                        $areacode = explode(",", auth()->user()->user_areas);
                        $builder->whereIN('area',  $areacode);
                    });
                }
            
            }
             // public function items(){
             //   return $this->hasManyDeep('App\RackItem',['App\Models\RackMaster','App\Models\RackMaster'],['plant_id','parent_id','rack_id']);
             // }
         
             //   return $this->hasMany('App\Models\RackMaster','plant_id');
             // }
         
             // public function users(){
             //   return $this->hasMany('App\User','plant_id');
             // }
             
            //  protected static function boot()
            //  {
            //      parent::boot();
              
            //      if(auth()->user()->user_sub_areas != ''){
            //        static::addGlobalScope('sub_areacode', function (Builder $builder) {      
            //            $sub_areacode = explode(",", auth()->user()->user_sub_areas);
            //            $builder->whereIN('sub_areacode',  $sub_areacode);
            //        });
            //      }
                
            //  }
}
