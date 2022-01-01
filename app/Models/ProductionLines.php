<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductionLines extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'production_lines';

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
                  'linedescription',
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
     * Get the linedescription for this model.
     */
    // public function linedescription()
    // {
    //     //return $this->belongsTo('App\Models\DropDowns','optionvalue');
    // }

    /**
     * Get the plant for this model.
     */
    public function plant()
    {
        return $this->belongsTo('App\Models\Plants','plant_id');
    }



}
