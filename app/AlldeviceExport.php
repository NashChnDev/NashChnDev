<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Models\devices;

class AlldeviceExport extends Model implements FromArray, WithHeadings
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
    
    public function headings(): array
    {
        $devices=new devices;
            $columns=$devices->getTableColumns();
        return [
            $columns
        ];
    }
    
            
           
       
}
