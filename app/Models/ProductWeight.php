<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'product_weights';

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
                  'name',
                  'product_group_parent_id',
                  'asset_id',
                  'quantity',
                  'weight',
                  'uom',
                  'description'
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
     * Get the productGroupParent for this model.
     */
    public function productGroupParent()
    {
        return $this->belongsTo('App\Models\ProductGroupParent','product_group_parent_id');
    }

    /**
     * Get the asset for this model.
     */
    public function asset()
    {
        return $this->belongsTo('App\Models\Asset','asset_id');
    }



}
