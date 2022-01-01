<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class employee_file_details extends Model
{
    
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'employee_file_details';

    /**
    * The database primary key value.
    *
    * @var string
    */
    protected $primaryKey = 'id';
    protected $guarded = [];    
    //protected $fillable = ['temp_empid','file_name','file_path','verified_status'];
}
