<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee_secondary_details extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_secondary_details';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $fillable = ['temp_empid','type_of','employee_details'];
}
