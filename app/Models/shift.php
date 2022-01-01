<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class shift extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'shifts';

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
                  'shiftcode',
                  'shiftname',
                  'shiftincharge',
                  'shiftstarttime',
                  'shiftendtime',
                  'createdby',
                  'company_id',
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
    public function company()
    {
        return $this->belongsTo('App\Models\Company','company_id');
    }
    
    
    public function deviceReq()
    {
      return $this->hasMany('App\Models\gaugerequestheader','shift','shiftcode');
    }



}
