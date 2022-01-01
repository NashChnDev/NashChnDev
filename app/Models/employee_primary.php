<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee_primary extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_primary';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';

    protected $guarded = [];    


    public function secondary_details()
    {
        return $this->hasMany('App\Models\employee_secondary_details','temp_empid');
    }

    public function file_details()
    {
        return $this->hasMany('App\Models\employee_file_details','temp_empid');
    }
    
}
