<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login'); //view('welcome');
});

Route::group(['middleware' => 'disablepreventback'],function(){
	Auth::routes();
	Route::get('/home', 'HomeController@index')->name('home');
});

/*
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

*/


Route::group(
[
    'prefix' => 'plants',
    'middleware' => 'auth',
   // 'middleware' => 'disablepreventback',
], function () {

    Route::get('/', 'PlantsController@index')
         ->name('plants.plants.index');

	Route::get('get-plants-dt-data', ['as'=>'get.plants.data','uses'=>'PlantsController@getIndexData']);
	
    Route::get('/create','PlantsController@create')
         ->name('plants.plants.create');

    Route::get('/show/{plants}','PlantsController@show')
         ->name('plants.plants.show')
         ->where('id', '[0-9]+');

    Route::get('/{plants}/edit','PlantsController@edit')
         ->name('plants.plants.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'PlantsController@store')
         ->name('plants.plants.store');
               
    Route::put('plants/{plants}', 'PlantsController@update')
         ->name('plants.plants.update')
         ->where('id', '[0-9]+');

    Route::delete('plants/{plants}','PlantsController@destroy')
         ->name('plants.plants.destroy')
         ->where('id', '[0-9]+');

});
Route::group(
     [
         'prefix' => 'department',
     ], function () {
     
         Route::get('/', 'DepartmentController@index')
              ->name('department.department.index');
     
         Route::get('get-department-dt-data', ['as'=>'get.department.data','uses'=>'DepartmentController@getIndexData']);
     
         Route::get('/create','DepartmentController@create')
              ->name('department.department.create');
     
         Route::get('/show/{department}','DepartmentController@show')
              ->name('department.department.show')
              ->where('id', '[0-9]+');
     
         Route::get('/{department}/edit','DepartmentController@edit')
              ->name('department.department.edit')
              ->where('id', '[0-9]+');
     
         Route::post('/', 'DepartmentController@store')
              ->name('department.department.store');
     
         Route::put('department/{department}', 'DepartmentController@update')
              ->name('department.department.update')
              ->where('id', '[0-9]+');
     
         Route::delete('/department/{department}','DepartmentController@destroy')
              ->name('department.department.destroy')
              ->where('id', '[0-9]+');
     
     //     Route::get('/getStateDetails/{id_for}','CompaniesController@getStateDetails');
     //     Route::get('/getCityDetails/{id_for}','CompaniesController@getCityDetails');
     
     });

     Route::group(
          [
              'prefix' => 'area',
          ], function () {
          
              Route::get('/', 'AreaController@index')
                   ->name('area.area.index');
          
              Route::get('get-area-dt-data', ['as'=>'get.area.data','uses'=>'AreaController@getIndexData']);
          
              Route::get('/create','AreaController@create')
                   ->name('area.area.create');
          
              Route::get('/show/{area}','AreaController@show')
                   ->name('area.area.show')
                   ->where('id', '[0-9]+');
          
              Route::get('/{area}/edit','AreaController@edit')
                   ->name('area.area.edit')
                   ->where('id', '[0-9]+');
          
              Route::post('/', 'AreaController@store')
                   ->name('area.area.store');
                   
                   
          
              Route::put('area/{area}', 'AreaController@update')
                   ->name('area.area.update')
                   ->where('id', '[0-9]+');
          
              Route::delete('/area/{area}','AreaController@destroy')
                   ->name('area.area.destroy')
                   ->where('id', '[0-9]+');
               Route::get('/getdepartDetails/{plant}','AreaController@getdepartment')
                   ->name('area.area.getdeprt')
                   ->where('id', '[0-9]+');
                   
          
          //     Route::get('/getStateDetails/{id_for}','CompaniesController@getStateDetails');
          //     Route::get('/getCityDetails/{id_for}','CompaniesController@getCityDetails');
          
          });

Route::group(
          [
               'prefix' => 'sub_area',
          ], function () {
               
               Route::get('/', 'SubareaController@index')
                    ->name('sub_area.sub_area.index');
               
               Route::get('get-sub_area-dt-data', ['as'=>'get.sub_area.data','uses'=>'SubareaController@getIndexData']);
               
               Route::get('/create','SubareaController@create')
                    ->name('sub_area.sub_area.create');
               
               Route::get('/show/{sub_area}','SubareaController@show')
                   ->name('sub_area.sub_area.show')
                   ->where('id', '[0-9]+');
               Route::get('/{sub_area}/edit','SubareaController@edit')
                    ->name('sub_area.sub_area.edit')
                    ->where('id', '[0-9]+');
               
               Route::post('/', 'SubareaController@store')
                    ->name('sub_area.sub_area.store');
               Route::post('/store','SubareaController@store')
                    ->name('sub_area.sub_area.store');
               
               Route::put('sub_area/{sub_area}', 'SubareaController@update')
                   ->name('sub_area.sub_area.update')
                   ->where('id', '[0-9]+');
              Route::delete('/sub_area/{sub_area}','SubareaController@destroy')
                   ->name('sub_area.sub_area.destroy')
                    ->where('id', '[0-9]+');
               Route::get('/getdepartDetails/{plant}','SubareaController@getdepartment')
                    ->name('sub_area.sub_area.getdeprt')
                    ->where('id', '[0-9]+');
               Route::get('/getareaDetails/{plant}/{depart}','SubareaController@getarea')
                    ->name('sub_area.sub_area.getarea')
                    ->where('id', '[0-9]+');         
               
               //     Route::get('/getStateDetails/{id_for}','CompaniesController@getStateDetails');
               //     Route::get('/getCityDetails/{id_for}','CompaniesController@getCityDetails');
               
          });



Route::group(
[
    'prefix' => 'drop_downs',
    'middleware' => 'auth',
], function () {

    Route::get('/', 'DropDownsController@index')
         ->name('drop_downs.drop_downs.index');

	Route::get('get-dropDowns-dt-data', ['as'=>'get.dropDowns.data','uses'=>'DropDownsController@getIndexData']);
	
    Route::get('/create','DropDownsController@create')
         ->name('drop_downs.drop_downs.create');

    Route::get('/show/{dropDowns}','DropDownsController@show')
         ->name('drop_downs.drop_downs.show')
         ->where('id', '[0-9]+');

    Route::get('/{dropDowns}/edit','DropDownsController@edit')
         ->name('drop_downs.drop_downs.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'DropDownsController@store')
         ->name('drop_downs.drop_downs.store');
               
    Route::put('drop_downs/{dropDowns}', 'DropDownsController@update')
         ->name('drop_downs.drop_downs.update')
         ->where('id', '[0-9]+');

    Route::delete('/drop_downs/{dropDowns}','DropDownsController@destroy')
         ->name('drop_downs.drop_downs.destroy')
         ->where('id', '[0-9]+');

});

Route::group(
[
    'prefix' => 'mailsms',
    'middleware' => 'auth',
], function () {

    Route::get('/', 'mailsmsController@index')
         ->name('mailsms.mailsms.index');

	Route::get('get-expirealertmail-dt-data', ['as'=>'get.expirealertmail.data','uses'=>'mailsmsController@getexpirealertmailIndexData']);
    
    Route::get('get-mailsms-dt-data', ['as'=>'get.mailsms.data','uses'=>'mailsmsController@getIndexData']);
    
    Route::get('get-alertsms-dt-data', ['as'=>'get.alertsms.data','uses'=>'mailsmsController@getalertsmsData']);
	
    Route::get('/create','mailsmsController@create')
         ->name('mailsms.mailsms.create');

    Route::get('/show/{mailsms}','mailsmsController@show')
         ->name('mailsms.mailsms.show')
         ->where('id', '[0-9]+');

    Route::get('/{mailsms}/edit','mailsmsController@edit')
         ->name('mailsms.mailsms.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'mailsmsController@store')
         ->name('mailsms.mailsms.store');
               
    Route::put('mailsms/{mailsms}', 'mailsmsController@update')
         ->name('mailsms.mailsms.update')
         ->where('id', '[0-9]+');

    Route::delete('/mailsms/{mailsms}','mailsmsController@destroy')
         ->name('mailsms.mailsms.destroy')
         ->where('id', '[0-9]+');

});


Route::group(
[
    'prefix' => 'companies',
    'middleware' => 'auth',
], function () {

    Route::get('/', 'CompaniesController@index')
         ->name('companies.company.index');

	Route::get('get-company-dt-data', ['as'=>'get.company.data','uses'=>'CompaniesController@getIndexData']);
	
    Route::get('/create','CompaniesController@create')
         ->name('companies.company.create');

    Route::get('/show/{company}','CompaniesController@show')
         ->name('companies.company.show')
         ->where('id', '[0-9]+');

    Route::get('/{company}/edit','CompaniesController@edit')
         ->name('companies.company.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'CompaniesController@store')
         ->name('companies.company.store');
               
    Route::put('company/{company}', 'CompaniesController@update')
         ->name('companies.company.update')
         ->where('id', '[0-9]+');

    Route::delete('/company/{company}','CompaniesController@destroy')
         ->name('companies.company.destroy')
         ->where('id', '[0-9]+');
    
    Route::get('/getStateDetails/{id_for}','CompaniesController@getStateDetails');
    Route::get('/getCityDetails/{id_for}','CompaniesController@getCityDetails');
    Route::get('/getCountryDetails','CompaniesController@getCountryDetails');

});

Route::group(
     [
         'prefix' => 'newjoiner',
         'middleware' => 'auth',
     ], function () {
     
         Route::get('/', 'NewjoinierController@index')
              ->name('newjoiner.employee.index');
     
          Route::get('get-newemployee-dt-data', ['as'=>'get.newemployee.data','uses'=>'NewjoinierController@getIndexData']);
          
         Route::get('/create','NewjoinierController@create')
              ->name('newjoiner.employee.create');
     
         Route::get('/show/{employee}','NewjoinierController@show')
              ->name('newjoiner.employee.show')
              ->where('id', '[0-9]+');
     
         Route::get('/{employee}/edit','NewjoinierController@edit')
              ->name('newjoiner.employee.edit')
              ->where('id', '[0-9]+');
     
         Route::get('/personal_detail/{id}/{type}','NewjoinierController@personaldetail')     
               ->name('newjoiner.employee.personal_detail');         
     
         Route::post('/', 'NewjoinierController@store')
              ->name('newjoiner.employee.store');
                    
         Route::put('employee/{employee}', 'NewjoinierController@update')
              ->name('newjoiner.employee.update')
              ->where('id', '[0-9]+');
     
         Route::delete('/employee/{employee}','NewjoinierController@destroy')
              ->name('newjoiner.employee.destroy')
              ->where('id', '[0-9]+');
              Route::get('/getdepartDetails/{plant}','NewjoinierController@getdepartment')
              ->name('newjoiner.employee.getdeprt')
              ->where('id', '[0-9]+');
        Route::get('/getareaDetails/{plant}/{depart}','NewjoinierController@getarea')
              ->name('newjoiner.employee.getarea')
              ->where('id', '[0-9]+');
     
         Route::get('/getmaillink/{id}','NewjoinierController@maillinkdetail')->name('employees.employee.getmaillink');          
     
     });


Route::group(
[
    'prefix' => 'employees',
    'middleware' => 'auth',
], function () {

    Route::get('/', 'EmployeesController@index')
         ->name('employees.employee.index');

	Route::get('get-employee-dt-data', ['as'=>'get.employee.data','uses'=>'EmployeesController@getIndexData']);
	
    Route::get('/create','EmployeesController@create')
         ->name('employees.employee.create');

    Route::get('/show/{employee}','EmployeesController@show')
         ->name('employees.employee.show')
         ->where('id', '[0-9]+');

    Route::get('/{employee}/edit','EmployeesController@edit')
         ->name('employees.employee.edit')
         ->where('id', '[0-9]+');

    Route::get('/personal_detail/{id}/{type}','EmployeesController@personaldetail')     
          ->name('employees.employee.personal_detail');         

    Route::post('/', 'EmployeesController@store')
         ->name('employees.employee.store');
               
    Route::put('employee/{employee}', 'EmployeesController@update')
         ->name('employees.employee.update')
         ->where('id', '[0-9]+');

    Route::delete('/employee/{employee}','EmployeesController@destroy')
         ->name('employees.employee.destroy')
         ->where('id', '[0-9]+');
         Route::get('/getdepartDetails/{plant}','NewjoinierController@getdepartment')
         ->name('assure_master.assure.getdeprt')
         ->where('id', '[0-9]+');
   Route::get('/getareaDetails/{plant}/{depart}','NewjoinierController@getarea')
         ->name('assure_master.assure.getarea')
         ->where('id', '[0-9]+');

    Route::get('/getmaillink/{id}','EmployeesController@maillinkdetail')->name('employees.employee.getmaillink');          

});


Route::group(
     [
     'prefix' => 'enrollform'     
     ],function(){
          Route::get('/{id}','EnrollController@index')->name('enrollform.enrollform.index');   
          
          
});

Route::group(
     [
     'prefix' => 'joiningform',
     'middleware' => 'auth',
     ],function(){
          Route::get('/','JoiningformController@index')->name('joiningform.joiningform.index');
          Route::get('/joiningformdata', ['as'=>'get.joiningform.data','uses'=>'JoiningformController@getIndexData']);
          Route::get('/nashemployee','JoiningformController@nashemployee')->name('joiningform.joiningform.nashemployee');
          Route::get('/personalDetail/{id}/{type}','JoiningformController@personaldetail')->name('joiningform.joiningform.personal');
          Route::get('/getchecklist/{id}','JoiningformController@checklistdetail')->name('joiningform.checklist');
          Route::get('/getmaillink/{id}','JoiningformController@maillinkdetail')->name('joiningform.getmaillink');          
          Route::post('/updateempcode','JoiningformController@updateempcode')->name('updateempcode');
          Route::post('/personalDetail/storepersonaldetail', 'JoiningformController@addPersonaldetail')->name('joiningform.storepersonaldetail');  
          Route::post('/personalDetail/storefiledetail', 'JoiningformController@addfiledetails')->name('joiningform.addfiledetails');  
          Route::post('/saveprofiledet', 'JoiningformController@saveprofiledet')->name('saveprofiledet');  
          

          Route::post('/employee', 'JoiningformController@store')->name('joiningform.joiningform.store');
          Route::post('/uploademployee', 'JoiningformController@uploademployee')->name('uploademployee');
          Route::post('/savepersonalbasic', 'JoiningformController@savepersonaldetails')->name('savepersonalbasic');
          Route::post('/savefiledetails', 'JoiningformController@savefiledetails')->name('savefiledetails');
          Route::post('/educationsave', 'JoiningformController@educationsave')->name('educationsave');
          Route::post('/savemanage', 'JoiningformController@savemanage')->name('savemanage');
          Route::post('/saverating', 'JoiningformController@savemanage')->name('saverating');
          
          

          
          Route::get('/getplant/{id}','JoiningformController@getplantdetails')->name('getplant');
          Route::get('/getarea/{id}','JoiningformController@getareadetails')->name('getarea');
          Route::get('/getsubarea/{id}','JoiningformController@getsubareadetails')->name('getsubarea');
          
          
          Route::get('/getpersonaldetails/{id}','JoiningformController@getpersonaldetails')->name('getpersonal');
          Route::get('/getpromotionsdetails/{id}','JoiningformController@getpromotionsdetails')->name('getpromotion');
          Route::get('/geteducationdetails/{id}','JoiningformController@geteducationdetails')->name('geteducationdetails');          
          Route::get('/getfiledetails/{id}/{basepath}','JoiningformController@getfiledetails')->name('getfiledetails');
          Route::get('/getemployeefiles/{id}','JoiningformController@getemployeefiles')->name('getemployeefiles');
          Route::get('/deletefiles/{fileid}/{tempid}','JoiningformController@deletefiles')->name('deletefiles');
          Route::get('/employeeverfied/{fileid}/{tempid}','JoiningformController@employeeverfied')->name('employeeverfied');          
          Route::get('/hrverfied/{fileid}/{tempid}','JoiningformController@hrverfied')->name('hrverfied');         

          
          Route::get('/statelist/{id}','JoiningformController@statelist')->name('statelist');
          Route::get('/citylist/{id}','JoiningformController@citylist')->name('citylist');
          Route::get('/dropdowns','JoiningformController@dropdowns')->name('citylist');
          

          
         
});
Route:: group( [
     'prefix' => 'resignerlist',
     'middleware' => 'auth',
     ],function(){
          Route::get('/','ResignerController@index')->name('resignerindex');
          Route::post('/saveresigner','ResignerController@store')->name('resignerstore');
          Route::get('resignerdata','ResignerController@getdata')->name('getdataresigner');
     });

     Route::group(
          [
              'prefix' => 'roles',
          ], function () {
          
              Route::get('/', 'RolesController@index')
                   ->name('roles.role.index');
          
               Route::get('get-role-dt-data', ['as'=>'get.role.data','uses'=>'RolesController@getIndexData']);
          
              Route::get('/create','RolesController@create')
                   ->name('roles.role.create');
          
              Route::get('/show/{role}','RolesController@show')
                   ->name('roles.role.show')
                   ->where('id', '[0-9]+');
          
              Route::get('/{role}/edit','RolesController@edit')
                   ->name('roles.role.edit')
                   ->where('id', '[0-9]+');
          
              Route::post('/', 'RolesController@store')
                   ->name('roles.role.store');
          
              Route::put('role/{role}', 'RolesController@update')
                   ->name('roles.role.update')
                   ->where('id', '[0-9]+');
          
              Route::delete('/role/{role}','RolesController@destroy')
                   ->name('roles.role.destroy')
                   ->where('id', '[0-9]+');
          
          });

          Route::get('/get-permissions-by-scope/{name}','RolesController@getPermissionByScope')->middleware('auth');


Route::group(
     [
         'prefix' => 'users',
     ], function () {
     
         Route::get('/', 'UsersController@index')
              ->name('users.user.index');
     
          Route::get('get-user-dt-data', ['as'=>'get.user.data','uses'=>'UsersController@getIndexData']);
     
         Route::get('/create','UsersController@create')
              ->name('users.user.create');
     
         Route::get('/show/{user}','UsersController@show')
              ->name('users.user.show')
              ->where('id', '[0-9]+');
     
         Route::get('/{user}/edit','UsersController@edit')
              ->name('users.user.edit')
              ->where('id', '[0-9]+');
     
         Route::post('/', 'UsersController@store')
              ->name('users.user.store');
     
         Route::put('user/{user}', 'UsersController@update')
              ->name('users.user.update')
              ->where('id', '[0-9]+');
     
         Route::delete('/user/{user}','UsersController@destroy')
              ->name('users.user.destroy')
              ->where('id', '[0-9]+');
         Route::get('/user/changepassword',function(){
             return view('users.changepassword');
         })->name('users.user.changepassword');
         Route::post('/user/changepassword/{id}','UsersController@changepassword')->name('users.user.changemypassword');
         Route::post('/getdepartDetails','UsersController@getdepartment')
         ->name('users.user.getdeprt')
         ->where('id', '[0-9]+');
          Route::post('/getareaDetails','UsersController@getarea')
          ->name('users.user.getarea')
          ->where('id', '[0-9]+');
     });

Route::get('change_password', 'Auth\ChangePasswordController@showChangePasswordForm')->name('auth.change_password');
Route::patch('change_password', 'Auth\ChangePasswordController@changePassword')->name('auth.change_password');

Route::group(
[
    'prefix' => 'configurations',
    'middleware' => 'auth',
], function () {

    Route::get('/', 'ConfigurationsController@index')
         ->name('configurations.configurations.index');

	Route::get('get-configurations-dt-data', ['as'=>'get.configurations.data','uses'=>'ConfigurationsController@getIndexData']);
	
    Route::get('/create','ConfigurationsController@create')
         ->name('configurations.configurations.create');

    Route::get('/show/{configurations}','ConfigurationsController@show')
         ->name('configurations.configurations.show')
         ->where('id', '[0-9]+');

    Route::get('/{configurations}/edit','ConfigurationsController@edit')
         ->name('configurations.configurations.edit')
         ->where('id', '[0-9]+');

    Route::post('/', 'ConfigurationsController@store')
         ->name('configurations.configurations.store');
               
    Route::put('configurations/{configurations}', 'ConfigurationsController@update')
         ->name('configurations.configurations.update')
         ->where('id', '[0-9]+');

    Route::delete('/configurations/{configurations}','ConfigurationsController@destroy')
         ->name('configurations.configurations.destroy')
         ->where('id', '[0-9]+');
    
    Route::post('/autosave/{Gauge_Request_Number}', 'ConfigurationsController@autosave')
         ->name('configurations.configurations.autosave');

});



Route::group(
[
    'prefix' => 'reports',
], function () {
    
    Route::get('/', 'ReportController@deviceReport')
         ->name('reports.deviceReport');
    
    Route::get('get-devicesReport-dt-data', ['as'=>'get.devicesReport.data','uses'=>'ReportController@getDeviceReportData']);
    
    Route::get('/ExportdeviceReport', 'ReportController@ExportdeviceReport')
         ->name('reports.ExportdeviceReport');
    
    Route::get('/ExportAlldeviceReport', 'ReportController@ExportAlldeviceReport')
         ->name('reports.ExportAlldeviceReport');
    
    Route::get('/calibrationReport', 'ReportController@calibrationReport')
         ->name('reports.calibrationReport');
    
    Route::get('get-calibrateReport-dt-data', ['as'=>'get.calibrateReport.data','uses'=>'ReportController@getCalibrateReportData']);
    
    Route::get('/ExportCalibrationReport', 'ReportController@ExportCalibrationReport')
         ->name('reports.ExportCalibrationReport');
    
    Route::get('/ExportAllCalibrationReport', 'ReportController@ExportAllCalibrationReport')
         ->name('reports.ExportAllCalibrationReport');
    
    Route::get('/deviceRIR_Report', 'ReportController@deviceRIR_Report')
         ->name('reports.deviceRIR_Report');
    
    Route::get('get-deviceRIR_Report-dt-data', ['as'=>'get.deviceRIR_Report.data','uses'=>'ReportController@getdeviceRIR_ReportData']);
    
     Route::get('/ExportdeviceRIRReport', 'ReportController@ExportdeviceRIRReport')
         ->name('reports.ExportdeviceRIRReport');
    
    Route::get('/ExportAlldeviceRIRReport', 'ReportController@ExportAlldeviceRIRReport')
         ->name('reports.ExportAlldeviceRIRReport');
    
    Route::get('/overall_HistoryCard', 'ReportController@overall_HistoryCard')
         ->name('reports.overall_HistoryCard');
    
    Route::get('get-overall_HistoryCard-dt-data', ['as'=>'get.overall_HistoryCard.data','uses'=>'ReportController@getoverall_HistoryCardReportData']);
    
    Route::get('/ExportOverallHistoryCard', 'ReportController@ExportOverallHistoryCard')
         ->name('reports.ExportOverallHistoryCard');
    
    Route::get('/ExportAllOverallHistoryCard', 'ReportController@ExportAllOverallHistoryCard')
         ->name('reports.ExportAllOverallHistoryCard');
    
    
    
});

Route::get('/EmptyDBTable', 'ReportController@EmptyDBTable')
    ->name('reports.EmptyDBTable');


