<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromArray;

class deviceErrorExport extends Model implements FromArray
{
    
    protected $data;
    
    public function __construct(array $data)
    {
        $this->data=$data;
    }
    
    public function array(): array
    {
        return $this->data;
    }
    
}
