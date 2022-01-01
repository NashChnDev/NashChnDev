<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\Importable;
use App\Models\devices;
use DateTime;

class DeviceImport implements ToModel,WithValidation,SkipsOnFailure,WithHeadingRow
{
    
    use Importable,SkipsFailures;
    
    private $headings=array();
    
    public function __construct(array $headings)
    {
        $this->headings=$headings;
    }

    
    public function model(array $row)
    {
                
                    $devices_dateofpurchase = $row[$this->headings[19]];                
                    $devices_dateofpurchase = date_create($devices_dateofpurchase);
                    $devices_dateofpurchase = date_format($devices_dateofpurchase,"Y-m-d");    		
                    
        
                    $lastcalibrationdate = $row[$this->headings[20]];                
                    $lastcalibrationdate = date_create($lastcalibrationdate);
                    $lastcalibrationdate = date_format($lastcalibrationdate,"Y-m-d");    		
                   
        
                    $expirydate = $row[$this->headings[21]];                
                    $expirydate = date_create($expirydate);
                    $expirydate = date_format($expirydate,"Y-m-d");    		
                   
        
                    $devices_CalibratedOn = $row[$this->headings[22]];                
                    $devices_CalibratedOn = date_create($devices_CalibratedOn);
                    $devices_CalibratedOn = date_format($devices_CalibratedOn,"Y-m-d");    		
                   
                   
        return new devices([
            
            'devices_id'                                => $row[$this->headings[0]],  
            'device_scategory'                          => $row[$this->headings[1]],
            'device_VariableType'                       => $row[$this->headings[2]],
            'device_MechanismType'                      => $row[$this->headings[3]],
            'devices_description'                       => $row[$this->headings[4]],
            'device_sasseterpcode'                      => $row[$this->headings[5]],
            'devices_sizerange'                         => $row[$this->headings[6]],
            'device_smake'                              => $row[$this->headings[7]],
            'devices_units'                             => $row[$this->headings[8]],
            'devices_property'                          => $row[$this->headings[9]],
            'devices_storgelocation'                    => $row[$this->headings[10]],
            'devices_alerydays'                         => $row[$this->headings[11]],
            'devices_leastcount'                        => $row[$this->headings[12]],
            'devices_accuracy'                          => $row[$this->headings[13]],
            'devices_acceptancecriteria'                => $row[$this->headings[14]],
            'devices_frequencyofCalibration'            => $row[$this->headings[15]],
            'devices_frequencyofCalibration_duration'   => $row[$this->headings[16]],
            'device_NorIN'                              => $row[$this->headings[17]],
            'vendors_id'                                => $row[$this->headings[18]],
            'devices_dateofpurchase'                    => $devices_dateofpurchase,
            'lastcalibrationdate'                       => $lastcalibrationdate,
            'expirydate'                                => $expirydate,
            'devices_CalibratedOn'                      => $devices_CalibratedOn,
            'devices_CalibrationResult'                 => $row[$this->headings[23]],
            'customer_id'                               => $row[$this->headings[24]],
            'plant_id'                                  => $row[$this->headings[25]]
                 
        ]);
    }
    
    /* public function startRow(): int
    {
        return 2;
    }*/
    
     public function rules(): array
    {
        return [
            
            
            $this->headings[0] =>'required|unique:devices,devices_id',
            $this->headings[1] =>'required|exists:drop_downs,optionvalue',
            $this->headings[2] =>'required|exists:drop_downs,optionvalue',
            $this->headings[3] =>'required|exists:drop_downs,optionvalue',
            $this->headings[4] =>'required|exists:drop_downs,optionvalue',
            $this->headings[5] =>'nullable',
            $this->headings[6] =>'required',
            $this->headings[7] =>'required',
            $this->headings[8] =>'required|exists:drop_downs,optionvalue',
            $this->headings[9] =>'required|exists:drop_downs,optionvalue',
            $this->headings[10] =>'required|exists:drop_downs,optionvalue',
            $this->headings[11] =>'required|numeric',
            $this->headings[12] =>'required',
            $this->headings[13] =>'required',
            $this->headings[14] =>'required',
            $this->headings[15] =>'required',
            $this->headings[16] =>'required',
            $this->headings[17] =>'required',
            $this->headings[18] =>'required|exists:vendors,vendorcode',
            $this->headings[19] =>'required',
            $this->headings[20] =>'required',
            $this->headings[21] =>'required',
            $this->headings[22] =>'required',
            $this->headings[23] =>'nullable',
            $this->headings[24] =>'nullable|exists:customers,customercode',
            $this->headings[25] =>'required|exists:plants,plantcode'
        ];
    }
}
