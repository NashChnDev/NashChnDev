<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;

class RolesTableSeeder extends Seeder
{
    public function run()
    {
        
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        
        Role::insert([
        	['name'=>'Super Admin','guard_name'=>'web'],
        	['name'=>'Admin','guard_name'=>'web'],
            ['name'=>'Plant Admin','guard_name'=>'web'],
        ]);
        Permission::insert(
        	[
            ['name'=>'create_companies','guard_name'=>'web'],
        	['name'=>'edit_companies','guard_name'=>'web'],
        	['name'=>'view_companies','guard_name'=>'web'],
        	['name'=>'delete_companies','guard_name'=>'web'],
                
        	['name'=>'create_plants','guard_name'=>'web'],
        	['name'=>'edit_plants','guard_name'=>'web'],
        	['name'=>'view_plants','guard_name'=>'web'],
        	['name'=>'delete_plants','guard_name'=>'web'],
                
            ['name'=>'create_department','guard_name'=>'web'],
        	['name'=>'edit_department','guard_name'=>'web'],
        	['name'=>'view_department','guard_name'=>'web'],
        	['name'=>'delete_department','guard_name'=>'web'],
                
            ['name'=>'create_employee','guard_name'=>'web'],
        	['name'=>'edit_employee','guard_name'=>'web'],
        	['name'=>'view_employee','guard_name'=>'web'],
        	['name'=>'delete_employee','guard_name'=>'web'],
                
            ['name'=>'create_customer','guard_name'=>'web'],
        	['name'=>'edit_customer','guard_name'=>'web'],
        	['name'=>'view_customer','guard_name'=>'web'],
        	['name'=>'delete_customer','guard_name'=>'web'],
                
            ['name'=>'create_vendor','guard_name'=>'web'],
        	['name'=>'edit_vendor','guard_name'=>'web'],
        	['name'=>'view_vendor','guard_name'=>'web'],
        	['name'=>'delete_vendor','guard_name'=>'web'],
                
            ['name'=>'create_device','guard_name'=>'web'],
        	['name'=>'edit_device','guard_name'=>'web'],
        	['name'=>'view_device','guard_name'=>'web'],
        	['name'=>'delete_device','guard_name'=>'web'],
                
            ['name'=>'create_shift','guard_name'=>'web'],
        	['name'=>'edit_shift','guard_name'=>'web'],
        	['name'=>'view_shift','guard_name'=>'web'],
        	['name'=>'delete_shift','guard_name'=>'web'],
                
            ['name'=>'create_devReq','guard_name'=>'web'],
        	['name'=>'edit_devReq','guard_name'=>'web'],
        	['name'=>'view_devReq','guard_name'=>'web'],
        	['name'=>'delete_devReq','guard_name'=>'web'],
                
            ['name'=>'devIssue','guard_name'=>'web'],
        	['name'=>'devReturn','guard_name'=>'web'],
        	
            ['name'=>'create_caliReq','guard_name'=>'web'],
        	['name'=>'edit_caliReq','guard_name'=>'web'],
        	['name'=>'view_caliReq','guard_name'=>'web'],
        	['name'=>'delete_caliReq','guard_name'=>'web'],
                
            ['name'=>'caliIssue','guard_name'=>'web'],
        	['name'=>'caliReceipt','guard_name'=>'web'],
        	['name'=>'caliBilling','guard_name'=>'web'],
                
            ['name'=>'create_scrapReq','guard_name'=>'web'],
        	['name'=>'edit_scrapReq','guard_name'=>'web'],
        	['name'=>'view_scrapReq','guard_name'=>'web'],
        	['name'=>'delete_scrapReq','guard_name'=>'web'],
                
            ['name'=>'scrapApproval','guard_name'=>'web'],
                
            ['name'=>'activityReport','guard_name'=>'web'],
            ['name'=>'logReport','guard_name'=>'web'],
        	
                
        	['name'=>'create_users','guard_name'=>'web'],
        	['name'=>'edit_users','guard_name'=>'web'],
        	['name'=>'view_users','guard_name'=>'web'],
        	['name'=>'delete_users','guard_name'=>'web'],
        	
            ['name'=>'create_dashboard_masters','guard_name'=>'web'],
            ['name'=>'edit_dashboard_masters','guard_name'=>'web'],
            ['name'=>'view_dashboard_masters','guard_name'=>'web'],
            ['name'=>'delete_dashboard_masters','guard_name'=>'web'],
                
            ['name'=>'create_roles','guard_name'=>'web'],
            ['name'=>'edit_roles','guard_name'=>'web'],
            ['name'=>'view_roles','guard_name'=>'web'],
            ['name'=>'delete_roles','guard_name'=>'web'],
                
            ['name'=>'create_dropdowns','guard_name'=>'web'],
            ['name'=>'edit_dropdowns','guard_name'=>'web'],
            ['name'=>'view_dropdowns','guard_name'=>'web'],
            ['name'=>'delete_dropdowns','guard_name'=>'web'],
            
        ]
        );
        $role=Role::where('name','Super Admin')->first()->syncPermissions(Permission::pluck('id'));
        User::where('name','admin')->first()->assignRole([$role->id]);
    }
}
