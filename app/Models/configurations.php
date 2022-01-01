<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class configurations extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'configurations';

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
                  'key',
                  'reqprefix',
                  'reqsuffix',
                  'is_active',
                  'keyvalue',
                  'entrydate',
                  'createdby',
                  'company_id'
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



}
