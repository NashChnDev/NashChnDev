<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmployeeBasic extends Model
{
    //
    protected $table = 'employee_base_details';
    protected $primaryKey = 'id';
    protected $guarded = []; 
}
