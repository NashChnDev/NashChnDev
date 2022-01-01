<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'cities';

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
                  'city_name',
                  'city_short_name',
                  'state_id',
                  'city_active',
                  'created_by',
                  'created_date',
                  'altered_by',
                  'altered_date'
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
     * Get the state for this model.
     */
    public function state()
    {
        return $this->belongsTo('App\Models\State','state_id');
    }

    /**
     * Get the creator for this model.
     */
    public function creator()
    {
        return $this->belongsTo('App\User','created_by');
    }

    /**
     * Get the alteredBy for this model.
     */
    public function alteredBy()
    {
        return $this->belongsTo('App\User','altered_by');
    }

    /**
     * Set the created_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setCreatedDateAttribute($value)
    {
        $this->attributes['created_date'] = !empty($value) ? \DateTime::createFromFormat($this->getDateFormat(), $value) : null;
    }

    /**
     * Set the altered_date.
     *
     * @param  string  $value
     * @return void
     */
    public function setAlteredDateAttribute($value)
    {
        $this->attributes['altered_date'] = !empty($value) ? \DateTime::createFromFormat($this->getDateFormat(), $value) : null;
    }

    /**
     * Get created_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getCreatedDateAttribute($value)
    {
        return \DateTime::createFromFormat('j/n/Y', $value);

    }

    /**
     * Get altered_date in array format
     *
     * @param  string  $value
     * @return array
     */
    public function getAlteredDateAttribute($value)
    {
        return \DateTime::createFromFormat('j/n/Y', $value);

    }

}
