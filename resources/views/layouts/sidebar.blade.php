  
  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-light-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{!! url('/') !!}" class="brand-link bg-white elevation-1" >
      <img src="{{ asset('img/0.png') }}" alt="Brand Logo" class="brand-image img-circle elevation-3"
           style="opacity: 1">
     <span class="brand-text font-weight-light"> <b>HR Management</b></span>
    </a>
      <br>
    
    <!-- Sidebar   --> 
    <div class="sidebar">
      <!-- Sidebar user panel (optional) 
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
          <a href="#" class="d-block">Alexander Pierce</a>
        </div>
      </div>
-->
      <!-- Sidebar Menu (Use  menu-open to expand)-->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
		  <!--<li class="nav-item">
            <a href="{{ route('home') }}" class="nav-link">
              <i class="fas fa-tachometer-alt nav-icon"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>-->
            

@if(auth()->user()->can('create_companies')||auth()->user()->can('edit_companies')||auth()->user()->can('view_companies')||auth()->user()->can('delete_companies')
||
auth()->user()->can('create_plants')||auth()->user()->can('edit_plants')||auth()->user()->can('view_plants')||auth()->user()->can('delete_plants')
||
auth()->user()->can('create_department')||auth()->user()->can('edit_department')||auth()->user()->can('view_department')||auth()->user()->can('delete_department')
||
auth()->user()->can('create_area')||auth()->user()->can('edit_area')||auth()->user()->can('view_area')||auth()->user()->can('delete_area')
||
auth()->user()->can('create_sub_area')||auth()->user()->can('edit_sub_area')||auth()->user()->can('view_sub_area')||auth()->user()->can('delete_sub_area')
||
auth()->user()->can('create_employees')||auth()->user()->can('edit_employees')||auth()->user()->can('view_employees')||auth()->user()->can('delete_employees')
||
auth()->user()->can('create_customers')||auth()->user()->can('edit_customers')||auth()->user()->can('view_customers')||auth()->user()->can('delete_customers')
||
auth()->user()->can('create_vendors')||auth()->user()->can('edit_vendors')||auth()->user()->can('view_vendors')||auth()->user()->can('delete_vendors') 
||
auth()->user()->can('create_devices')||auth()->user()->can('edit_devices')||auth()->user()->can('view_devices')||auth()->user()->can('delete_devices') 
||
auth()->user()->can('create_shifts')||auth()->user()->can('edit_shifts')||auth()->user()->can('view_shifts')||auth()->user()->can('delete_shifts') 
||
auth()->user()->can('create_roles')||auth()->user()->can('edit_roles')||auth()->user()->can('view_roles')||auth()->user()->can('delete_roles')
||
auth()->user()->can('create_users')||auth()->user()->can('edit_users')||auth()->user()->can('view_users')||auth()->user()->can('delete_users')
||
auth()->user()->can('create_drop_downs')||auth()->user()->can('edit_drop_downs')||auth()->user()->can('view_drop_downs')||auth()->user()->can('delete_drop_downs')
)   
         <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-sitemap"></i>
              <p>
                Masters
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
       @if(auth()->user()->can('create_companies')||auth()->user()->can('edit_companies')||auth()->user()->can('view_companies')||auth()->user()->can('delete_companies'))       
                <li class="nav-item">
                <a href="{{ url('companies')}}" class="nav-link">
                  <i class="fas fa-people-carry nav-icon"></i>
                  <p>Company</p>
                </a>
              </li>
           @endif     
              
         @if(auth()->user()->can('create_plants')||auth()->user()->can('edit_plants')||auth()->user()->can('view_plants')||auth()->user()->can('delete_plants'))        
              <li class="nav-item">
                <a href="{{ url('plants')}}" class="nav-link">
                  <i class="fas fa-people-carry nav-icon"></i>
                  <p>Plant</p>
                </a>
              </li>
            @endif     
               
            @if(auth()->user()->can('create_department')||auth()->user()->can('edit_department')||auth()->user()->can('view_department')||auth()->user()->can('delete_department'))
            <li class="nav-item">
              <a href="{{ url('department')}}" class="nav-link">
                <i class="fas fa-city nav-icon"></i>
                <p>Department</p>
              </a>
            </li>
            @endif

            @if(auth()->user()->can('create_area')||auth()->user()->can('edit_area')||auth()->user()->can('view_area')||auth()->user()->can('delete_area'))
              <li class="nav-item">
                <a href="{{ url('area')}}" class="nav-link">
                  <i class="fas fa-city nav-icon"></i>
                  <p>Area</p>
                </a>
              </li>
              @endif
            @if(auth()->user()->can('create_sub_area')||auth()->user()->can('edit_sub_area')||auth()->user()->can('view_sub_area')||auth()->user()->can('delete_sub_area'))
              <li class="nav-item">
                <a href="{{ url('sub_area')}}" class="nav-link">
                  <i class="fas fa-city nav-icon"></i>
                  <p>Sub Area</p>
                </a>
              </li>
              @endif
              @if(auth()->user()->can('create_drop_downs')||auth()->user()->can('edit_drop_downs')||auth()->user()->can('view_drop_downs')||auth()->user()->can('delete_drop_downs'))
              <li class="nav-item">
                <a href="{{ url('drop_downs')}}" class="nav-link">
                  <i class="fas fa-city nav-icon"></i>
                  <p>Drop Downs</p>
                </a>
              </li>
              @endif
            
                {{-- @if(auth()->user()->can('create_employees')||auth()->user()->can('edit_employees')||auth()->user()->can('view_employees')||auth()->user()->can('delete_employees'))
                  <li class="nav-item">
                <a href="{{ url('employees')}}" class="nav-link">
                  <i class="fas fa-city nav-icon"></i>
                  <p>Employee</p>
                </a>
              </li>
                @endif                --}}
                           
            </ul>
          </li>
@endif
            

            
                      <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="nav-icon fa fa-table"></i>
              <p>
                HR Activities 
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              @if(auth()->user()->can('create_joininer')||auth()->user()->can('view_joininer')||auth()->user()->can('edit_joininer')||auth()->user()->can('delete_joininer')) 
                <li class="nav-item">
                  {{-- <a href="{{ url('joiningform')}}" class="nav-link"> --}}
                    <a href="{{ url('newjoiner')}}" class="nav-link">                    
                    <i class="fa fa-hand-holding-usd nav-icon"></i>
                    <p>New Joininer</p>
                  </a>
                </li>
              @endif  

                 @if(auth()->user()->can('create_employees')||auth()->user()->can('edit_employees')||auth()->user()->can('view_employees')||auth()->user()->can('delete_employees'))
                  <li class="nav-item">
                    <a href="{{ url('employees')}}" class="nav-link">
                      <i class="fas fa-city nav-icon"></i>
                      <p>Nash Employee</p>
                    </a>
                  </li>
                @endif               
              @if(auth()->user()->can('create_resigner')||auth()->user()->can('view_resigner')||auth()->user()->can('edit_resigner')||auth()->user()->can('delete_resigner')) 
                <li class="nav-item">
                  <a href="{{ url('resignerlist')}}" class="nav-link">
                    <i class="fa fa-hand-holding-usd nav-icon"></i>
                    <p>Resigner List</p>
                  </a>
                </li>
              @endif          
            </ul>
          </li>
            
           
            
          <li class="nav-header">Settings</li>
         
            <li class="nav-item">
                <a href="{{ route('auth.change_password') }}" class="nav-link">
                  <i class="fas fa-user-lock nav-icon"></i>
                  <p>Change Password</p>
                </a>
              </li>
            
           
          
     @if(auth()->user()->can('create_companies')||auth()->user()->can('create_roles')||auth()->user()->can('edit_roles')||auth()->user()->can('view_roles')||auth()->user()->can('delete_roles')|| auth()->user()->can('create_usersetting')||auth()->user()->can('edit_usersetting')||auth()->user()->can('view_usersetting')||auth()->user()->can('delete_usersetting') )
          
          <li class="nav-item has-treeview">
            <a href="#" class="nav-link">
              <i class="fas fa-shield-alt nav-icon"></i> 
              <p>
                User Management
                <i class="fa fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
                
              @if(auth()->user()->can('create_roles')||auth()->user()->can('edit_roles')||auth()->user()->can('view_roles')||auth()->user()->can('delete_roles'))
              <li class="nav-item">
                <a href="{{ url('roles')}}" class="nav-link">
                  <i class="fas fa-city nav-icon"></i>
                  <p>Roles</p>
                </a>
              </li>
              @endif
                
              @if(auth()->user()->can('create_users')||auth()->user()->can('edit_users')||auth()->user()->can('view_users')||auth()->user()->can('delete_users'))
                  <li class="nav-item">
                        <a href="{{route('users.user.index')}}" class="nav-link">
                          <i class="fas fa-user-lock nav-icon"></i>
                          <p>Users</p>
                        </a>
                  </li>
              @endif
 
            </ul>
          </li>            
      @endif
      {{-- @endif       --}}
            
       </ul>
      </nav>
      
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

