<?php

namespace App\Http\Controllers;

use App\Models\Vendors;
use App\Models\devices;
use App\Models\Company;
use App\Models\Customer;
use App\Models\DropDowns;
use App\DeviceImport;
use App\Selected_deviceRIRReport;
use App\deviceErrorExport;
use App\SelecteddeviceExport;
use App\AlldeviceExport;
use App\Selected_CalibrationReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\DevicesFormRequest;
use Exception;
use Validator;
use App\Models\Plants;
use App\Models\gaugerequestdetail;
use Auth;
use Gate;
use DB;
use Excel;
use Maatwebsite\Excel\Concerns\FromCollection;
use DateTime;
use Yajra\Datatables\Datatables;
use Maatwebsite\Excel\HeadingRowImport;
use Illuminate\Support\Collection;
use App\Models\calibration;
use App\Models\calibrations_details;
use App\Models\historycard;

class ReportController extends Controller
{
    
   public function deviceReport()
   {
       $optionvaluesDevDescriptions = DropDowns::where('fieldsname',config('constants.options_from_db')['devices_description'])->pluck('optionvalue','id');
       $optionvaluesCategory        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Catagory'])->pluck('optionvalue','id');
       $optionvaluesUsage_Location  = DropDowns::where('fieldsname',config('constants.options_from_db')['Usage_Location'])->pluck('optionvalue','id');
       
       return view('reports.device', compact('optionvaluesDevDescriptions','optionvaluesCategory','optionvaluesUsage_Location'));
   }
    
        public function getDeviceReportData()
    {
        if(Gate::allows('super_admin'))
        {
		  $devicesObjects = devices::with('vendor','customer','optionvalue','company');
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $devicesObjects = devices::with('vendor','customer','optionvalue','company')->whereIn('plant_id', $Auth_plants);  
        }
            
          //  dd($devicesObjects);
        
		return Datatables::of($devicesObjects)->filter(function ($query){
            
                                  if(request()->has('fromdate') && request('fromdate')!="" && request('fromdate')!="all")
                                  {
                                      $fromdate = request("fromdate");
                                      $date = \DateTime::createFromFormat('d/m/Y', $fromdate);
                                      $fromdate = ($date->format('Y-m-d'));
                                      $query->whereDate('created_at','>=',$fromdate);
                                  }
                                  if(request()->has('todate') && request('todate')!="" && request('todate')!="")
                                  {
                                    $todate=request("todate");
                                    $date = \DateTime::createFromFormat('d/m/Y', $todate);
                                    $todate = ($date->format('Y-m-d'));
                                    $query->whereDate('created_at','<=',$todate);
                                  }
                                  if(request()->has('devicecatagory') && request('devicecatagory')!="" && request('devicecatagory')!="all")
                                  {
                                     // dd($query);
                                    $devicecatagory = request("devicecatagory");
                                    $query->where('device_scategory',$devicecatagory);
                                  }
                                 if(request()->has('devicedescription') && request('devicedescription')!="" && request('devicedescription')!="all")
                                  {
                                    $devicedescription = request("devicedescription");
                                    $query->where('devices_description',$devicedescription);
                                  }
                                if(request()->has('deviceusagelocation') && request('deviceusagelocation')!="" && request('deviceusagelocation')!="all")
                                  {
                                    $deviceusagelocation = request("deviceusagelocation");
                                    $query->where('devices_storgelocation',$deviceusagelocation);
                                  }
                                if(request()->has('devicepurchasefromdate') && request('devicepurchasefromdate')!="" && request('devicepurchasefromdate')!="all")
                                  {
                                    $devicepurchasefromdate = request("devicepurchasefromdate");
                                    $devicepurchasefromdate = \DateTime::createFromFormat('d/m/Y', $devicepurchasefromdate);
                                    $devicepurchasefromdate = ($devicepurchasefromdate->format('Y-m-d'));
                                    $query->whereDate('devices_dateofpurchase','>=',$devicepurchasefromdate);
                                  } 
                                if(request()->has('devicepurchasetodate') && request('devicepurchasetodate')!="" && request('devicepurchasetodate')!="all")
                                  {
                                    $devicepurchasetodate = request("devicepurchasetodate");
                                    $devicepurchasetodate = \DateTime::createFromFormat('d/m/Y', $devicepurchasetodate);
                                    $devicepurchasetodate = ($devicepurchasetodate->format('Y-m-d'));
                                    $query->whereDate('devices_dateofpurchase','<=',$devicepurchasetodate);
                                  }
                                if(request()->has('status') && request('status')!="" && request('status')!="all")
                                  {
                                    $status = request("status");
                                    $query->where('status',$status);
                                  }
                                                                                            
                              }
                            )->make(true);
    }
    
    
    public function ExportdeviceReport(Excel $excel, Request $request )
    {
        
        $SelectedValue =    $request->selectExport;
        
        if($SelectedValue == null)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
        
        if(count($SelectedValue) == 0)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
         
        $data = devices::whereIn('id',$SelectedValue)->get()->toArray();
        
           $export = new SelecteddeviceExport($data);
               
            return Excel::download($export, 'Selected_Devices.xlsx'); 
    }

    
    
    public function ExportAlldeviceReport()
    {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $devicesObjects = devices::with('vendor','customer','optionvalue','company')->whereIn('plant_id', $Auth_plants)->get()->toArray();
        
        if($devicesObjects == null)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
        if(count($devicesObjects) == 0)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
           $export = new AlldeviceExport($devicesObjects);
               
            return Excel::download($export,'Devices.xlsx');
        
    }
    
    
    public function calibrationReport()
    {
      
         
        if(Gate::allows('super_admin'))
        {
		  $devicesObjects = devices::with('vendor','customer','optionvalue','company')->get();
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $devicesObjects = devices::with('vendor','customer','optionvalue','company')->whereIn('plant_id', $Auth_plants)->get();  
        }
        $optionvaluesDevDescriptions = DropDowns::where('fieldsname',config('constants.options_from_db')['devices_description'])->pluck('optionvalue','id');
       $optionvaluesCategory        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Catagory'])->pluck('optionvalue','id');
       
        return view('reports.calibrate', compact('optionvaluesDevDescriptions','optionvaluesCategory','devicesObjects'));  
    }
    
    
    public function getCalibrateReportData()
    {
        
        if(Gate::allows('super_admin'))
        {
            $calibrations = DB::table('calibrations')
            ->leftJoin('calibrations_details', 'calibrations_details.calibrationreqno_id', '=', 'calibrations.calibrationreqno')->select(
     'calibrations.*',
     'calibrations_details.id as calibrations_details_id',
     'calibrations_details.created_at as calibrations_details_created_at',
     'calibrations_details.updated_at as calibrations_details_updated_at',
     'calibrations_details.calibrationreqno_id as calibrations_details_calibrationreqno_id',
     'calibrations_details.calibrationreqdate as calibrations_details_calibrationreqdate',
     'calibrations_details.devices_id as calibrations_details_devices_id',
     'calibrations_details.devicescategory as calibrations_details_devicescategory',
     'calibrations_details.devicesdescription as calibrations_details_devicesdescription',
     'calibrations_details.deviceserpcode as calibrations_details_deviceserpcode',
     'calibrations_details.devicessizerange as calibrations_details_devicessizerange',
     'calibrations_details.quantity as calibrations_details_quantity',
     'calibrations_details.clibration_source as calibrations_details_clibration_source',
     'calibrations_details.vendorcode as calibrations_details_vendorcode',
     'calibrations_details.vendordescription as calibrations_details_vendordescription',
     'calibrations_details.grnno as calibrations_details_grnno',
     'calibrations_details.grndate as calibrations_details_grndate',
     'calibrations_details.grnremarks as calibrations_details_grnremarks',
     'calibrations_details.invoiceno as calibrations_details_invoiceno',
     'calibrations_details.invoicedate as calibrations_details_invoicedate',
     'calibrations_details.refno as calibrations_details_refno',
     'calibrations_details.receiptno as calibrations_details_receiptno',
     'calibrations_details.receiptdate as calibrations_details_receiptdate',
     'calibrations_details.receiptentryby as calibrations_details_receiptentryby',
     'calibrations_details.calibratedon as calibrations_details_calibratedon',
     'calibrations_details.calibratedby as calibrations_details_calibratedby',
     'calibrations_details.calibratedresult as calibrations_details_calibratedresult',
     'calibrations_details.calibratedcertificate as calibrations_details_calibratedcertificate',
     'calibrations_details.pono as calibrations_details_pono',
     'calibrations_details.podate as calibrations_details_podate',
     'calibrations_details.servicesheet as calibrations_details_servicesheet',
     'calibrations_details.billingno as calibrations_details_billingno',
     'calibrations_details.billingdate as calibrations_details_billingdate',
     'calibrations_details.billingremarks as calibrations_details_billingremarks',
     'calibrations_details.reportattachment as calibrations_details_reportattachment',
     'calibrations_details.entrydate as calibrations_details_entrydate',
     'calibrations_details.createdby as calibrations_details_createdby',
     'calibrations_details.company_id as calibrations_details_company_id',
     'calibrations_details.plant_id as calibrations_details_plant_id',
     'calibrations_details.calibrationissueremarks as calibrations_details_calibrationissueremarks',
     'calibrations_details.status as calibrations_details_status',
     'calibrations_details.device_old_status as calibrations_details_device_old_status');
           
        }
        else
        {
           $Auth_plants = explode(',',Auth::user()->plantcode_id);
            
            $calibrations = DB::table('calibrations')
            ->leftJoin('calibrations_details', 'calibrations_details.calibrationreqno_id', '=', 'calibrations.calibrationreqno')->select(
     'calibrations.*',
     'calibrations_details.id as calibrations_details_id',
     'calibrations_details.created_at as calibrations_details_created_at',
     'calibrations_details.updated_at as calibrations_details_updated_at',
     'calibrations_details.calibrationreqno_id as calibrations_details_calibrationreqno_id',
     'calibrations_details.calibrationreqdate as calibrations_details_calibrationreqdate',
     'calibrations_details.devices_id as calibrations_details_devices_id',
     'calibrations_details.devicescategory as calibrations_details_devicescategory',
     'calibrations_details.devicesdescription as calibrations_details_devicesdescription',
     'calibrations_details.deviceserpcode as calibrations_details_deviceserpcode',
     'calibrations_details.devicessizerange as calibrations_details_devicessizerange',
     'calibrations_details.quantity as calibrations_details_quantity',
     'calibrations_details.clibration_source as calibrations_details_clibration_source',
     'calibrations_details.vendorcode as calibrations_details_vendorcode',
     'calibrations_details.vendordescription as calibrations_details_vendordescription',
     'calibrations_details.grnno as calibrations_details_grnno',
     'calibrations_details.grndate as calibrations_details_grndate',
     'calibrations_details.grnremarks as calibrations_details_grnremarks',
     'calibrations_details.invoiceno as calibrations_details_invoiceno',
     'calibrations_details.invoicedate as calibrations_details_invoicedate',
     'calibrations_details.refno as calibrations_details_refno',
     'calibrations_details.receiptno as calibrations_details_receiptno',
     'calibrations_details.receiptdate as calibrations_details_receiptdate',
     'calibrations_details.receiptentryby as calibrations_details_receiptentryby',
     'calibrations_details.calibratedon as calibrations_details_calibratedon',
     'calibrations_details.calibratedby as calibrations_details_calibratedby',
     'calibrations_details.calibratedresult as calibrations_details_calibratedresult',
     'calibrations_details.calibratedcertificate as calibrations_details_calibratedcertificate',
     'calibrations_details.pono as calibrations_details_pono',
     'calibrations_details.podate as calibrations_details_podate',
     'calibrations_details.servicesheet as calibrations_details_servicesheet',
     'calibrations_details.billingno as calibrations_details_billingno',
     'calibrations_details.billingdate as calibrations_details_billingdate',
     'calibrations_details.billingremarks as calibrations_details_billingremarks',
     'calibrations_details.reportattachment as calibrations_details_reportattachment',
     'calibrations_details.entrydate as calibrations_details_entrydate',
     'calibrations_details.createdby as calibrations_details_createdby',
     'calibrations_details.company_id as calibrations_details_company_id',
     'calibrations_details.plant_id as calibrations_details_plant_id',
     'calibrations_details.calibrationissueremarks as calibrations_details_calibrationissueremarks',
     'calibrations_details.status as calibrations_details_status',
     'calibrations_details.device_old_status as calibrations_details_device_old_status')->whereIn('calibrations_details_plant_id', $Auth_plants); 
          
        }
        
        
        
          //  ->get();
       
          //  dd($calibrations);
        
		  return Datatables::of($calibrations)->filter(function ($query){
            
                                  if(request()->has('fromdate') && request('fromdate')!="" && request('fromdate')!="all")
                                  {
                                      $fromdate = request("fromdate");
                                      $date = \DateTime::createFromFormat('d/m/Y', $fromdate);
                                      $fromdate = ($date->format('Y-m-d'));
                                      $query->whereDate('calibrations.created_at','>=',$fromdate);
                                  }
                                  if(request()->has('todate') && request('todate')!="" && request('todate')!="")
                                  {
                                    $todate=request("todate");
                                    $date = \DateTime::createFromFormat('d/m/Y', $todate);
                                    $todate = ($date->format('Y-m-d'));
                                    $query->whereDate('calibrations.created_at','<=',$todate);
                                  }
                                   if(request()->has('calibrateto') && request('calibrateto')!="" && request('calibrateto')!="all")
                                  {
                                     // dd($query);
                                    $calibrateto = request("calibrateto");
                                    $query->where('calibrate_to',$calibrateto);
                                  }
                                    if(request()->has('deviceid') && request('deviceid')!="" && request('deviceid')!="all")
                                  {
                                     // dd($query);
                                    $deviceid = request("deviceid");
                                    $query->where('calibrations_details.devices_id',$deviceid);
                                  }
                                  if(request()->has('devicecatagory') && request('devicecatagory')!="" && request('devicecatagory')!="all")
                                  {
                                     // dd($query);
                                    $devicecatagory = request("devicecatagory");
                                    $query->where('calibrations_details.devicescategory',$devicecatagory);
                                  }
                                 if(request()->has('devicedescription') && request('devicedescription')!="" && request('devicedescription')!="all")
                                  {
                                    $devicedescription = request("devicedescription");
                                    $query->where('calibrations_details.devicesdescription',$devicedescription);
                                  }
                                 if(request()->has('calibrationstatus') && request('calibrationstatus')!="" && request('calibrationstatus')!="all")
                                  {
                                    $calibrationstatus = request("calibrationstatus");
                                    $query->where('calibrations.calibrationreqstatus',$calibrationstatus);
                                  }
                                                                                                                         
                              }
                            )->make(true);
    }
    
    
    
    public function ExportCalibrationReport(Excel $excel, Request $request)
    {
         $SelectedValue =    $request->selectExport;
        
        if($SelectedValue == null)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
        
        if(count($SelectedValue) == 0)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
        
                $data = DB::table('calibrations')
            ->leftJoin('calibrations_details', 'calibrations_details.calibrationreqno_id', '=', 'calibrations.calibrationreqno')->select(
     'calibrations.*',
     'calibrations_details.id as calibrations_details_id',
     'calibrations_details.created_at as calibrations_details_created_at',
     'calibrations_details.updated_at as calibrations_details_updated_at',
     'calibrations_details.calibrationreqno_id as calibrations_details_calibrationreqno_id',
     'calibrations_details.calibrationreqdate as calibrations_details_calibrationreqdate',
     'calibrations_details.devices_id as calibrations_details_devices_id',
     'calibrations_details.devicescategory as calibrations_details_devicescategory',
     'calibrations_details.devicesdescription as calibrations_details_devicesdescription',
     'calibrations_details.deviceserpcode as calibrations_details_deviceserpcode',
     'calibrations_details.devicessizerange as calibrations_details_devicessizerange',
     'calibrations_details.quantity as calibrations_details_quantity',
     'calibrations_details.clibration_source as calibrations_details_clibration_source',
     'calibrations_details.vendorcode as calibrations_details_vendorcode',
     'calibrations_details.vendordescription as calibrations_details_vendordescription',
     'calibrations_details.grnno as calibrations_details_grnno',
     'calibrations_details.grndate as calibrations_details_grndate',
     'calibrations_details.grnremarks as calibrations_details_grnremarks',
     'calibrations_details.invoiceno as calibrations_details_invoiceno',
     'calibrations_details.invoicedate as calibrations_details_invoicedate',
     'calibrations_details.refno as calibrations_details_refno',
     'calibrations_details.receiptno as calibrations_details_receiptno',
     'calibrations_details.receiptdate as calibrations_details_receiptdate',
     'calibrations_details.receiptentryby as calibrations_details_receiptentryby',
     'calibrations_details.calibratedon as calibrations_details_calibratedon',
     'calibrations_details.calibratedby as calibrations_details_calibratedby',
     'calibrations_details.calibratedresult as calibrations_details_calibratedresult',
     'calibrations_details.calibratedcertificate as calibrations_details_calibratedcertificate',
     'calibrations_details.pono as calibrations_details_pono',
     'calibrations_details.podate as calibrations_details_podate',
     'calibrations_details.servicesheet as calibrations_details_servicesheet',
     'calibrations_details.billingno as calibrations_details_billingno',
     'calibrations_details.billingdate as calibrations_details_billingdate',
     'calibrations_details.billingremarks as calibrations_details_billingremarks',
     'calibrations_details.reportattachment as calibrations_details_reportattachment',
     'calibrations_details.entrydate as calibrations_details_entrydate',
     'calibrations_details.createdby as calibrations_details_createdby',
     'calibrations_details.company_id as calibrations_details_company_id',
     'calibrations_details.plant_id as calibrations_details_plant_id',
     'calibrations_details.calibrationissueremarks as calibrations_details_calibrationissueremarks',
     'calibrations_details.status as calibrations_details_status',
     'calibrations_details.device_old_status as calibrations_details_device_old_status')->whereIn('calibrations.calibrationreqno',$SelectedValue)->get()->toArray();
            

           $export = new Selected_CalibrationReport($data);
               
            return Excel::download($export, 'Selected_CalibrationReport.xlsx'); 
        
        

    }
    
    public function ExportAllCalibrationReport()
    {
        
         if(Gate::allows('super_admin'))
        {
            $data = DB::table('calibrations')
            ->leftJoin('calibrations_details', 'calibrations_details.calibrationreqno_id', '=', 'calibrations.calibrationreqno')->select(
     'calibrations.*',
     'calibrations_details.id as calibrations_details_id',
     'calibrations_details.created_at as calibrations_details_created_at',
     'calibrations_details.updated_at as calibrations_details_updated_at',
     'calibrations_details.calibrationreqno_id as calibrations_details_calibrationreqno_id',
     'calibrations_details.calibrationreqdate as calibrations_details_calibrationreqdate',
     'calibrations_details.devices_id as calibrations_details_devices_id',
     'calibrations_details.devicescategory as calibrations_details_devicescategory',
     'calibrations_details.devicesdescription as calibrations_details_devicesdescription',
     'calibrations_details.deviceserpcode as calibrations_details_deviceserpcode',
     'calibrations_details.devicessizerange as calibrations_details_devicessizerange',
     'calibrations_details.quantity as calibrations_details_quantity',
     'calibrations_details.clibration_source as calibrations_details_clibration_source',
     'calibrations_details.vendorcode as calibrations_details_vendorcode',
     'calibrations_details.vendordescription as calibrations_details_vendordescription',
     'calibrations_details.grnno as calibrations_details_grnno',
     'calibrations_details.grndate as calibrations_details_grndate',
     'calibrations_details.grnremarks as calibrations_details_grnremarks',
     'calibrations_details.invoiceno as calibrations_details_invoiceno',
     'calibrations_details.invoicedate as calibrations_details_invoicedate',
     'calibrations_details.refno as calibrations_details_refno',
     'calibrations_details.receiptno as calibrations_details_receiptno',
     'calibrations_details.receiptdate as calibrations_details_receiptdate',
     'calibrations_details.receiptentryby as calibrations_details_receiptentryby',
     'calibrations_details.calibratedon as calibrations_details_calibratedon',
     'calibrations_details.calibratedby as calibrations_details_calibratedby',
     'calibrations_details.calibratedresult as calibrations_details_calibratedresult',
     'calibrations_details.calibratedcertificate as calibrations_details_calibratedcertificate',
     'calibrations_details.pono as calibrations_details_pono',
     'calibrations_details.podate as calibrations_details_podate',
     'calibrations_details.servicesheet as calibrations_details_servicesheet',
     'calibrations_details.billingno as calibrations_details_billingno',
     'calibrations_details.billingdate as calibrations_details_billingdate',
     'calibrations_details.billingremarks as calibrations_details_billingremarks',
     'calibrations_details.reportattachment as calibrations_details_reportattachment',
     'calibrations_details.entrydate as calibrations_details_entrydate',
     'calibrations_details.createdby as calibrations_details_createdby',
     'calibrations_details.company_id as calibrations_details_company_id',
     'calibrations_details.plant_id as calibrations_details_plant_id',
     'calibrations_details.calibrationissueremarks as calibrations_details_calibrationissueremarks',
     'calibrations_details.status as calibrations_details_status',
     'calibrations_details.device_old_status as calibrations_details_device_old_status')->get()->toArray();
        }
        else
        {
           $Auth_plants = explode(',',Auth::user()->plantcode_id);
            $data = DB::table('calibrations')
            ->leftJoin('calibrations_details', 'calibrations_details.calibrationreqno_id', '=', 'calibrations.calibrationreqno')->select(
     'calibrations.*',
     'calibrations_details.id as calibrations_details_id',
     'calibrations_details.created_at as calibrations_details_created_at',
     'calibrations_details.updated_at as calibrations_details_updated_at',
     'calibrations_details.calibrationreqno_id as calibrations_details_calibrationreqno_id',
     'calibrations_details.calibrationreqdate as calibrations_details_calibrationreqdate',
     'calibrations_details.devices_id as calibrations_details_devices_id',
     'calibrations_details.devicescategory as calibrations_details_devicescategory',
     'calibrations_details.devicesdescription as calibrations_details_devicesdescription',
     'calibrations_details.deviceserpcode as calibrations_details_deviceserpcode',
     'calibrations_details.devicessizerange as calibrations_details_devicessizerange',
     'calibrations_details.quantity as calibrations_details_quantity',
     'calibrations_details.clibration_source as calibrations_details_clibration_source',
     'calibrations_details.vendorcode as calibrations_details_vendorcode',
     'calibrations_details.vendordescription as calibrations_details_vendordescription',
     'calibrations_details.grnno as calibrations_details_grnno',
     'calibrations_details.grndate as calibrations_details_grndate',
     'calibrations_details.grnremarks as calibrations_details_grnremarks',
     'calibrations_details.invoiceno as calibrations_details_invoiceno',
     'calibrations_details.invoicedate as calibrations_details_invoicedate',
     'calibrations_details.refno as calibrations_details_refno',
     'calibrations_details.receiptno as calibrations_details_receiptno',
     'calibrations_details.receiptdate as calibrations_details_receiptdate',
     'calibrations_details.receiptentryby as calibrations_details_receiptentryby',
     'calibrations_details.calibratedon as calibrations_details_calibratedon',
     'calibrations_details.calibratedby as calibrations_details_calibratedby',
     'calibrations_details.calibratedresult as calibrations_details_calibratedresult',
     'calibrations_details.calibratedcertificate as calibrations_details_calibratedcertificate',
     'calibrations_details.pono as calibrations_details_pono',
     'calibrations_details.podate as calibrations_details_podate',
     'calibrations_details.servicesheet as calibrations_details_servicesheet',
     'calibrations_details.billingno as calibrations_details_billingno',
     'calibrations_details.billingdate as calibrations_details_billingdate',
     'calibrations_details.billingremarks as calibrations_details_billingremarks',
     'calibrations_details.reportattachment as calibrations_details_reportattachment',
     'calibrations_details.entrydate as calibrations_details_entrydate',
     'calibrations_details.createdby as calibrations_details_createdby',
     'calibrations_details.company_id as calibrations_details_company_id',
     'calibrations_details.plant_id as calibrations_details_plant_id',
     'calibrations_details.calibrationissueremarks as calibrations_details_calibrationissueremarks',
     'calibrations_details.status as calibrations_details_status',
     'calibrations_details.device_old_status as calibrations_details_device_old_status')->whereIn('gaugerequestdetails.plant_id', $Auth_plants)->get()->toArray();  
        }
        
         
        if($data == null)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
        if(count($data) == 0)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
          $export = new Selected_CalibrationReport($data);
               
            return Excel::download($export, 'CalibrationReport.xlsx'); 
        
    }
    
    
    public function deviceRIR_Report()
    {
        /*$deviceRIR = gaugerequestdetail::with('device','issueReqlist','returnReqlist')->get();
        dd($deviceRIR);*/
              
        if(Gate::allows('super_admin'))
        {
		  $devicesObjects = devices::with('vendor','customer','optionvalue','company')->get();
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $devicesObjects = devices::with('vendor','customer','optionvalue','company')->whereIn('plant_id', $Auth_plants)->get();  
        }
        $optionvaluesDevDescriptions = DropDowns::where('fieldsname',config('constants.options_from_db')['devices_description'])->pluck('optionvalue','id');
       $optionvaluesCategory        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Catagory'])->pluck('optionvalue','id');
       $optionvaluesUsage_Location  = DropDowns::where('fieldsname',config('constants.options_from_db')['Usage_Location'])->pluck('optionvalue','id');
       
        return view('reports.deviceRIR', compact('optionvaluesDevDescriptions','optionvaluesCategory','devicesObjects','optionvaluesUsage_Location')); 
    }
    
       public function getdeviceRIR_ReportData()
    {
        
        if(Gate::allows('super_admin'))
        {
           $deviceRIR = gaugerequestdetail::with('device','issueReqlist','returnReqlist');
        }
        else
        {
           $Auth_plants = explode(',',Auth::user()->plantcode_id);
           $deviceRIR = gaugerequestdetail::with('device','issueDevicelist','returnDevicelist')->whereIn('plant_id', $Auth_plants);  
        }
           
                
		  return Datatables::of($deviceRIR)->filter(function ($query){
            
                                  if(request()->has('fromdate') && request('fromdate')!="" && request('fromdate')!="all")
                                  {
                                      $fromdate = request("fromdate");
                                      $date = \DateTime::createFromFormat('d/m/Y', $fromdate);
                                      $fromdate = ($date->format('Y-m-d'));
                                      $query->whereDate('created_at','>=',$fromdate);
                                  }
                                  if(request()->has('todate') && request('todate')!="" && request('todate')!="")
                                  {
                                    $todate=request("todate");
                                    $date = \DateTime::createFromFormat('d/m/Y', $todate);
                                    $todate = ($date->format('Y-m-d'));
                                    $query->whereDate('created_at','<=',$todate);
                                  }
                                    if(request()->has('deviceid') && request('deviceid')!="" && request('deviceid')!="all")
                                  {
                                     // dd($query);
                                    $deviceid = request("deviceid");
                                    $query->where('devices_id',$deviceid);
                                  }
                                  if(request()->has('devicecatagory') && request('devicecatagory')!="" && request('devicecatagory')!="all")
                                  {
                                     // dd($query);
                                    $devicecatagory = request("devicecatagory");
                                    $query->where('devicescategory',$devicecatagory);
                                  }
                                 if(request()->has('devicedescription') && request('devicedescription')!="" && request('devicedescription')!="all")
                                  {
                                    $devicedescription = request("devicedescription");
                                    $query->where('devicesdescription',$devicedescription);
                                  }
                                 if(request()->has('deviceusagelocation') && request('deviceusagelocation')!="" && request('deviceusagelocation')!="all")
                                  {
                                    $deviceusagelocation = request("deviceusagelocation");
                                    $query->whereHas('device',function($q)use($deviceusagelocation){$q->where('devices_storgelocation',$deviceusagelocation);});
                                  }
                                 if(request()->has('issuestatus') && request('issuestatus')!="" && request('issuestatus')!="all")
                                  {
                                    $issuestatus = request("issuestatus");
                                    $query->where('issue_entry',$issuestatus);
                                  }
                                 if(request()->has('returnstatus') && request('returnstatus')!="" && request('returnstatus')!="all")
                                  {
                                    $returnstatus = request("returnstatus");
                                    $query->whereHas('issueReqlist',function($q)use($returnstatus){$q->where('return_entry',$returnstatus);});
                                  }
                                                                                                                         
                              }
                            )->make(true);
    }
    
    
        public function ExportdeviceRIRReport(Excel $excel, Request $request )
    {
        
        $SelectedValue =    $request->selectExport;
        
        if($SelectedValue == null)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
        
        if(count($SelectedValue) == 0)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
            
          $data = DB::table('gaugerequestdetails')
                  ->leftJoin('gaugeissuedetails', 'gaugeissuedetails.gaugereqno_id', '=', 'gaugerequestdetails.gaugereqno_id')  
                  ->leftJoin('gaugereturndetails', 'gaugereturndetails.gaugereqno_id', '=', 'gaugerequestdetails.gaugereqno_id')  
                  ->leftJoin('devices', 'devices.devices_id', '=', 'gaugerequestdetails.devices_id')  
                  ->whereIn('gaugerequestdetails.gaugereqno_id',$SelectedValue)->get()->toArray();
                        
             // dd(array_keys((array)$data[0]));
            
        
           $export = new Selected_deviceRIRReport($data);
               
            return Excel::download($export, 'Selected_Devices_RIR_Report.xlsx'); 
    }

    
    
    public function ExportAlldeviceRIRReport()
    {
        if(Gate::allows('super_admin'))
        {
           $data = DB::table('gaugerequestdetails')
                  ->leftJoin('gaugeissuedetails', 'gaugeissuedetails.gaugereqno_id', '=', 'gaugerequestdetails.gaugereqno_id')  
                  ->leftJoin('gaugereturndetails', 'gaugereturndetails.gaugereqno_id', '=', 'gaugerequestdetails.gaugereqno_id')  
                  ->leftJoin('devices', 'devices.devices_id', '=', 'gaugerequestdetails.devices_id')  
                  ->get()->toArray();
        }
        else
        {
           $Auth_plants = explode(',',Auth::user()->plantcode_id);
           $data = DB::table('gaugerequestdetails')
                  ->leftJoin('gaugeissuedetails', 'gaugeissuedetails.gaugereqno_id', '=', 'gaugerequestdetails.gaugereqno_id')  
                  ->leftJoin('gaugereturndetails', 'gaugereturndetails.gaugereqno_id', '=', 'gaugerequestdetails.gaugereqno_id')  
                  ->leftJoin('devices', 'devices.devices_id', '=', 'gaugerequestdetails.devices_id')  
                  ->whereIn('gaugerequestdetails.plant_id', $Auth_plants)->get()->toArray();  
        }
        
         
        if($data == null)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
        if(count($data) == 0)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
           $export = new Selected_deviceRIRReport($data);
               
            return Excel::download($export,'Devices_RIR_Report.xlsx');
        
    }
    
    
    public function overall_HistoryCard()
    {
        
       /* $HistoryCard_Data = historycard::orderBy('devices_id', 'ASC')->get();//->groupBy('devices_id');
        dd($HistoryCard_Data);*/
        
        if(Gate::allows('super_admin'))
        {
		  $devicesObjects = devices::with('vendor','customer','optionvalue','company')->get();
        }
        else
        {
          $Auth_plants = explode(',',Auth::user()->plantcode_id);
          $devicesObjects = devices::with('vendor','customer','optionvalue','company')->whereIn('plant_id', $Auth_plants)->get();  
        }
        $optionvaluesDevDescriptions = DropDowns::where('fieldsname',config('constants.options_from_db')['devices_description'])->pluck('optionvalue','id');
       $optionvaluesCategory        = DropDowns::where('fieldsname',config('constants.options_from_db')['Devices_Catagory'])->pluck('optionvalue','id');
       
       
        return view('reports.overall_HistoryCard', compact('optionvaluesDevDescriptions','optionvaluesCategory','devicesObjects')); 
        
    }
    
    
           public function getoverall_HistoryCardReportData()
    {
        
        if(Gate::allows('super_admin'))
        {
           $HistoryCard_Data = historycard::orderBy('devices_id', 'ASC');//->groupBy('devices_id');
            
        }
        else
        {
           $Auth_plants = explode(',',Auth::user()->plantcode_id);
           $HistoryCard_Data = historycard::orderBy('devices_id', 'ASC')->whereIn('plant_id', $Auth_plants);  
        }
        
		  return Datatables::of($HistoryCard_Data)->filter(function ($query){
            
                                  if(request()->has('fromdate') && request('fromdate')!="" && request('fromdate')!="all")
                                  {
                                      $fromdate = request("fromdate");
                                      $date = \DateTime::createFromFormat('d/m/Y', $fromdate);
                                      $fromdate = ($date->format('Y-m-d'));
                                      $query->whereDate('created_at','>=',$fromdate);
                                  }
                                  if(request()->has('todate') && request('todate')!="" && request('todate')!="")
                                  {
                                    $todate=request("todate");
                                    $date = \DateTime::createFromFormat('d/m/Y', $todate);
                                    $todate = ($date->format('Y-m-d'));
                                    $query->whereDate('created_at','<=',$todate);
                                  }
                                    if(request()->has('deviceid') && request('deviceid')!="" && request('deviceid')!="all")
                                  {
                                     // dd($query);
                                    $deviceid = request("deviceid");
                                    $query->where('devices_id',$deviceid);
                                  }
                                  if(request()->has('devicecatagory') && request('devicecatagory')!="" && request('devicecatagory')!="all")
                                  {
                                     // dd($query);
                                    $devicecatagory = request("devicecatagory");
                                    $query->where('device_scategory',$devicecatagory);
                                  }
                                 if(request()->has('devicedescription') && request('devicedescription')!="" && request('devicedescription')!="all")
                                  {
                                    $devicedescription = request("devicedescription");
                                    $query->where('devices_description',$devicedescription);
                                  }
                                                                                                                         
                              }
                            )->make(true);
    }
    
    
    public function ExportOverallHistoryCard(Excel $excel, Request $request )
    {
        
          $SelectedValue =    $request->selectExport;
        
        if($SelectedValue == null)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
        
        if(count($SelectedValue) == 0)
        {
           return redirect()->back()->withErrors('Please Select Atleast one Record');   
        }
            
          $data = historycard::orderBy('devices_id', 'ASC')->whereIn('devices_id', $SelectedValue)->get()->toArray();  
        
           $export = new Selected_deviceRIRReport($data);
               
            return Excel::download($export, 'Selected_OverallHistoryCard.xlsx'); 
        
    }
    
    public function ExportAllOverallHistoryCard()
    {
        if(Gate::allows('super_admin'))
        {
           $data = historycard::orderBy('devices_id', 'ASC')->get()->toArray();  
        }
        else
        {
           $Auth_plants = explode(',',Auth::user()->plantcode_id);
           $data = historycard::orderBy('devices_id', 'ASC')->whereIn('plant_id', $Auth_plants)->get()->toArray();    
        }
        
         
        if($data == null)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
        if(count($data) == 0)
        {
           return redirect()->back()->withErrors('Data Not Found');   
        }
        
           $export = new Selected_deviceRIRReport($data);
               
            return Excel::download($export,'ExportAllOverallHistoryCard.xlsx');
        
    }




    public function EmptyDBTable()
    {
        DB::table('calibrations_details')->delete();
        DB::table('calibrations')->delete();
        DB::table('companies')->delete();
        DB::table('customers')->delete();
        DB::table('departments')->delete();
        DB::table('devices')->delete();
        DB::table('drop_downs')->delete();
        DB::table('employees')->delete();
        DB::table('gaugeissuedetails')->delete();
        DB::table('gaugeissueheaders')->delete();
        DB::table('gaugerequestdetails')->delete();
        DB::table('gaugerequestheaders')->delete();
        DB::table('gaugereturndetails')->delete();
        DB::table('historycards')->delete();
        DB::table('laravel_logger_activity')->delete();
        DB::table('plants')->delete();
        DB::table('scrapreqdetails')->delete();
        DB::table('scrapreqheaders')->delete();
        DB::table('scraps')->delete();
        DB::table('shifts')->delete();
        DB::table('vendors')->delete();


        return redirect()->route('home')
            ->with('success_message', 'successfully Deleted!');

    }
    

}
