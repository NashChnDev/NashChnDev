@extends('layouts.app')

@section('page-title','')

@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/personaldetail.css') }}" />
<div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Employee Details</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('joiningform.joiningform.index') }}">Joining Form</a></li>
                            <li class="breadcrumb-item active">Employee Details</li>
                            </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
             </div><!-- /.container-fluid -->
        </div>

    <section class="content"  id="section1">
  <div id="accordion">
  <div class="card">
  <button class="btn btn-link btncolor" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
    <div class="card-header" id="headingOne">
      <h6 class="mb-0" style="text-align:left">      
          Personal Particulars  
        
      </h6>
    </div>
    </button>

    <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordion">
      <div class="card-body">
             <div class="col-md-12 row" id="first_header">
             <input type="hidden" id="temp_id" value="{{ $employee_joining->id }}">
                <div class="col-md-5">
                    <div class="form-group inputs half">
                           <input type="text"  id="name"  placeholder=" " value="{{ $employee_joining->name }}">
                           <label >Name*</label>
                            <small style="display:none" class="form-text text-muted"></small>      
                    </div>     

                    <div class="form-group inputs half">
                            <input type="text" class="datepicker" id="date_birth"  placeholder=" " value="{{ $employee_joining->date_birth }}">
                            <label >Date of Birth*</label>
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group inputs half">
                        <input type="text" class="" id="blood_group"  placeholder="" value="{{ $employee_joining->blood_group }}">
                          <label >BloodGroup*</label>
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group inputs half">
                         <input type="text" class="" id="Mobile_no"  placeholder="" value="{{ $employee_joining->Mobile_no }}">
                         <label for="exampleInputEmail1">MobileNo*</label>
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                   
                    <div class="form-group  inputs half">
                    <label>Select Gender*</label>
                    <select class="form-control" id="gender"  value="{{ $employee_joining->gender }}">
                            <option value=''>Select Gender</option>
                            <option value='Male' {{$employee_joining->gender == 'Male'?'Selected':'' }}>Male</option>
                            <option value='Female'{{$employee_joining->gender == 'Female'?'Selected':'' }}>Female</option>
                            <option value='Others' {{$employee_joining->gender == 'Others'?'Selected':'' }}>Others</option></select>
                         
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                   
                  
                    <div class="form-group inputs half">
                        <textarea class="" id="present_address" rows="3" placeholder="" value="">{{ $employee_joining->present_address }}</textarea>
                        <label for="">Present Address*</label>
                    </div>

                </div>
                <div class="col-md-5">
                    <div class="form-group inputs half">
                        <input type="text" class="" id="email"  placeholder=" " value="{{ $employee_joining->email }}">
                        <label>EmailID*</label>
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                   
                                

                    <div class="form-group inputs half">
                        <input type="text" class="" id="religion"  placeholder="" value="{{ $employee_joining->religion }}">
                        <label for="exampleInputEmail1">Religion & Caste</label>
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group inputs half">
                            <input type="text" class="" id="language_known"  placeholder="" value="{{ $employee_joining->language_known }}">
                            <label for="exampleInputEmail1">Language Known</label>
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group inputs half">
                         <input type="text" class="" id="Mobile_no_secondary"  placeholder="" value="{{ $employee_joining->Mobile_no_secondary }}">
                           <label for="exampleInputEmail1">Alternate Phone No*</label>
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>
                    <div class="form-group  inputs half">
                    <label for="exampleInputEmail1">Select Martial Status*</label>
                    <select class="form-control" id="martial_status"  value="{{ $employee_joining->martial_status }}">
                        <option value=''>Select Martial Status</option>
                        <option {{$employee_joining->martial_status == 'Single'?'Selected':'' }}>Single</option>
                        <option {{$employee_joining->martial_status == 'Married'?'Selected':'' }}>Married</option>
                        <option {{$employee_joining->martial_status == 'Widowed'?'Selected':'' }}>Widowed</option>
                        <option {{$employee_joining->martial_status == 'Divorced'?'Selected':'' }}>Divorced</option>
                    </select>                         
                    <small style="display:none" class="form-text text-muted"></small>
                    </div>  
                   
                    <div class="form-group inputs half">
                        <textarea class="" id="permanent_address" rows="3" placeholder=" " value="">{{ $employee_joining->permanent_address }}</textarea>
                        <label for="">Permanent Address*</label>
                    </div>
                </div>   
                <div class="col-md-2" id="profileimage">
                    <div class="small-12 medium-2 large-2 columns">
                        <div class="circle">
                        <!-- User Profile Image -->
                        @if($employee_joining->profile_img == '')
                            <img class="profile-pic" src="{{URL::asset('/img/avatar04.png')}}" height="200" width="200">
                        @else
                        <img class="profile-pic" src="{{ asset('storage/profile')}}/{{$employee_joining->profile_img}}" height="200" width="200">   
                        @endif

                        <!-- Default Image -->
                        <!-- <i class="fa fa-user fa-5x"></i> -->
                        </div>
                        <div class="p-image">
                        <i class="fa fa-camera upload-button"></i>
                            <input class="file-upload" type="file" accept="image/*"/>
                        </div>
                    </div>
                </div>                      
            </div>
            <div class="card">
                <div class="card-header" id="headingTwo" style="background-color:#844484">
                <h5 class="mb-0">Family Members</h5>
                </div>               
                <div class="card-body">
                        <table class="table  table-striped table-bordered">
                        <thead>
                            <tr>                                
                                <td>Name</td>
                                <td>Relationship</td>
                                <td>DOB</td>
                                <td>Occuption</td>
                                <td>Contact.No</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="TextBoxContainer">
                        @if($employee_joining->secondary_details != null)                        
                            @foreach($employee_joining->secondary_details as $secondary_details)                           
                                @if($secondary_details->type_of == 'Family')
                                @foreach($secondary_details->employee_details as $family)
                                <tr>                                
                                        <td><input type="text" class="form-control names" value="{{$family['name']}}" placeholder="Name"></td>
                                        <td><input type="text" class="form-control relationship"   value="{{$family['relationship']}}" placeholder="Relationship"></td>
                                        <td><input type="text" class="form-control age"    value="{{$family['age']}}" placeholder="Age"></td>
                                        <td><input type="text" class="form-control education"  value="{{$family['education']}}" placeholder="Education"></td>
                                        <td><input type="text" class="form-control occuption"  value="{{$family['occuption']}}"  placeholder="Occuption"></td>
                                        <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash removeevent" aria-hidden="true"></i></span></td>
                                </tr>
                                @endforeach
                                @endif                                
                            @endforeach    
                            @endif
                                <tr>                                
                                        <td><input type="text" class="form-control names"   placeholder="Name"></td>
                                        <td><input type="text" class="form-control relationship"   placeholder="Relationship"></td>
                                        <td><input type="text" class="form-control dob"   placeholder="DOB"></td>
                                        <td><input type="text" class="form-control occuption"  placeholder="Occuption"></td>
                                        <td><input type="text" class="form-control contact"   placeholder="Contact"></td>
                                        <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span></td>
                                </tr>
                           
                        </tbody>               
                    </table>    
                </div>               
            </div>
            <button type="button" id="save_personal_details" class="btn btn-primary" style="float:right">Save Personal Details</button>
      </div>
    </div>
  </div>




  <div class="card">
    <button class="btn btn-link collapsed btncolor" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
      <div class="card-header" id="headingTwo">
      <h6 class="mb-0" style="text-align:left">    
            Education Details
          </h6>
      </div>
      </button>  
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card">
                <div class="card-body">
                                <table class="table  table-striped table-bordered">
                                      <thead>
                                          <tr>                                
                                           
                                              <td>Course/Programme</td>
                                              <td>Major Subject</td>                                              
                                              <td>Institute/Board/University</td>
                                              <td>Duration</td>                                          
                                              <td>Year of Passing</td>
                                              <td>Percentage/CGPA</td>
                                              <td>Action</td>
                                          </tr>
                                      </thead>
                                      <tbody id="education_details">
                                        @if($employee_joining->secondary_details != null)                        
                                            @foreach($employee_joining->secondary_details as $secondary_details)                           
                                                @if($secondary_details->type_of == 'Education')
                                                @if(!empty($secondary_details->employee_details['education']))
                                                @foreach($secondary_details->employee_details['education'] as $education)               
                                                <tr>                             
                                                        <td><input type="text" class="form-control course" value="{{$education['course']}}"  placeholder="BE"></td>
                                                        <td><input type="text" class="form-control subject" value="{{$education['subject']}}"  placeholder="Major Subject"></td>
                                                        <td><input type="text" class="form-control institute" value="{{$education['institute']}}"  placeholder="Institute/Board/University"></td>                                                  
                                                        <td><input type="text" class="form-control duration" value="{{$education['duration']}}" data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                                  
                                                        <td><input type="text" class="form-control passing"  value="{{$education['passing']}}"   placeholder="Year of Passing"></td>
                                                        <td><input type="text" class="form-control cgpa"   value="{{$education['cgpa']}}"  placeholder="Percentage/CGPA"></td>
                                                        <td><span><i class="fa fa-plus eduplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash eduremoveevent" aria-hidden="true"></i></span></td>
                                                </tr>                                                                               
                                                @endforeach
                                                @endif
                                                @endif                                
                                            @endforeach    
                                        @endif
                                                 <tr>                             
                                                  <td><input type="text" class="form-control course"  placeholder="BE"></td>
                                                  <td><input type="text" class="form-control subject"  placeholder="Major Subject"></td>
                                                  <td><input type="text" class="form-control institute"  placeholder="Institute/Board/University"></td>                                                  
                                                  <td><input type="text" class="form-control duration" data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                                  
                                                  <td><input type="text" class="form-control passing"   placeholder="Year of Passing"></td>
                                                  <td><input type="text" class="form-control cgpa"   placeholder="Percentage/CGPA"></td>
                                                  <td><span><i class="fa fa-plus eduplusevent" aria-hidden="true"></i></span></td>
                                                 </tr>                                
                                      </tbody>               
                                  </table>    

                </div>
               </div>    
              <div class="card">
                <div class="card-header" id="headingTwo" style="background-color:#844484">
                <h5 class="mb-0">Training Programme</h5>
                </div>               
                <div class="card-body">
                           <table class="table  table-striped table-bordered">
                              <thead>
                                  <tr>                                
                                      
                                      <td>Training</td>
                                      <td>Programme</td>
                                      <td>Organisation/Institute</td>                                     
                                      <td>Duration</td>                                                           
                                      <td>Action</td>
                                  </tr>
                              </thead>
                              <tbody id="training_details">

                              @if($employee_joining->secondary_details != null)                        
                                            @foreach($employee_joining->secondary_details as $secondary_details)                           
                                                @if($secondary_details->type_of == 'Education')
                                                @if(!empty($secondary_details->employee_details['training']))
                                                @foreach($secondary_details->employee_details['training'] as $trainings)               
                                            <tr>                                 
                                                    <td><select class="form-control training" >
                                                                        <option value=''>Select Option</option>
                                                                        <option value="App" {{ $trainings['training'] == 'App'?'Selected':'' }}   >Apprentice/In-Plant</option>
                                                                        <option value="PP" {{ $trainings['training'] == 'PP'?'Selected':'' }} >Professional</option></select></td>
                                                            <td><input type="text" class="form-control programme"  value="{{$trainings['programme']}}" placeholder="Programme"></td>
                                                            <td><input type="text" class="form-control institute" value="{{$trainings['institute']}}"  placeholder="Institute"></td>                                          
                                                            <td><input type="text" class="form-control duration" value="{{$trainings['duration']}}"  data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                          
                                                            <td><span><i class="fa fa-plus trainingplusevent" aria-hidden="true"></i></span></td>
                                                    </tr>
                                                    @endforeach
                                                @endif
                                                @endif                                
                                            @endforeach    
                                        @endif




                                 
                                  <tr>                                 
                                  <td><select class="form-control training"> <option value=''>Select Option</option><option value="App" >Apprentice/In-Plant</option><option value="PP">Professional</option></select></td>
                                          <td><input type="text" class="form-control programme"  placeholder="Programme"></td>
                                          <td><input type="text" class="form-control institute"  placeholder="Institute"></td>                                          
                                          <td><input type="text" class="form-control duration" data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                          
                                          <td><span><i class="fa fa-plus trainingplusevent" aria-hidden="true"></i></span></td>
                                  </tr>
                              </tbody>               
                           </table>    
                </div>               
              </div>
              <div class="card">
                <div class="card-header" id="headingTwo" style="background-color:#844484">
                <h5 class="mb-0">Computer Knowledge</h5>
                </div>               
                <div class="card-body">
                   <table class="table  table-striped table-bordered">
                              <thead>
                                  <tr>                                
                                      
                                      <td>Computer Knowledge</td>
                                      <td>Application</td>
                                      <td>Knowledge</td>
                                      <td>Action</td>
                                  </tr>
                              </thead>
                              <tbody id="computer_knowledge">

                              @if($employee_joining->secondary_details != null)                        
                                            @foreach($employee_joining->secondary_details as $secondary_details)                           
                                                @if($secondary_details->type_of == 'Education')
                                                @if(!empty($secondary_details->employee_details['computer']))
                                                @foreach($secondary_details->employee_details['computer'] as $computers)               
                                        <tr>                                                                        
                                        <td><select class="form-control cpk">
                                            <option value="">Select Option</option>
                                            <option value="Mso"  {{ $computers['cpk'] == 'Mso'?'Selected':'' }}>MS Office(Word; Excel; Power Point)</option>
                                            <option value="erp" {{ $computers['cpk'] == 'erp'?'Selected':'' }}>ERP</option>
                                            <option value="ds" {{ $computers['cpk'] == 'ds'?'Selected':'' }}>Designing Software</option>
                                            <option value="os"{{ $computers['cpk'] == 'os'?'Selected':'' }}  >Others, Specify</option>
                                          </select></td>
                                        <td><input type="text" class="form-control application" value="{{$computers['application']}}"></td>
                                        <td>
                                        <select class="form-control knowledge">
                                              <option value="kob" {{ $computers['knowledge'] == 'kob'?'Selected':'' }}>Know only Basic</option>
                                              <option value="hws" {{ $computers['knowledge'] == 'hws'?'Selected':'' }}>Has Working Skils</option>
                                              <option value="iw" {{ $computers['knowledge'] == 'iw'?'Selected':'' }}>Independently Work</option>
                                              <option value="exp" {{ $computers['knowledge'] == 'exp'?'Selected':'' }}>Expert</option>
                                        </select>
                                        </td>
                                        <td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash ckevent" aria-hidden="true"></i></span></td>
                                </tr> 
                                @endforeach
                                                @endif
                                                @endif                                
                                            @endforeach    
                                        @endif                           
                            <tr>               
                                        <td><select class="form-control cpk">
                                            <option value="">Select Option</option>
                                            <option value="Mso">MS Office(Word; Excel; Power Point)</option>
                                            <option value="erp">ERP</option>
                                            <option value="ds">Designing Software</option>
                                            <option value="os" >Others, Specify</option>
                                          </select></td>
                                        <td><input type="text" class="form-control application"></td>
                                        <td>
                                        <select class="form-control knowledge">
                                              <option value="kob">Know only Basic</option>
                                              <option value="hws">Has Working Skils</option>
                                              <option value="iw">Independently Work</option>
                                              <option value="exp">Expert</option>
                                        </select>
                                        </td>
                                        <td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span></td>
                                </tr>                               
                              </tbody>               
                          </table>    
                    </div>               
                </div>
                <button type="button" class="btn btn-primary" id="save_education_details" style="float:right">Save Education Details</button>
              </div>    
             
      </div>
     
  </div>

@if(empty($employee_joining->employee_id))

           <div class="card">
            <button class="btn btn-link collapsed btncolor" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <div class="card-header" id="headingThree">
                <h6 class="mb-0" style="text-align:left"> Employment Details               
                  </h6>
                </div>
              </button>
                  <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                  
                        <div class="card-body">
                            <table class="table  table-striped table-bordered">
                                <thead>
                                    <tr>                                
                                        
                                        <td>Organization</td>
                                        <td>Designation</td>
                                        <td>Period of Work </td>                                                                             
                                        <td>Total Duration</td>
                                        <td>Job Description</td>                                      
                                        <td>Last Drawn Gross Salary</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody id="employment_details">

                                @if($employee_joining->secondary_details != null)                        
                            @foreach($employee_joining->secondary_details as $secondary_details)                           
                                @if($secondary_details->type_of == 'employment')
                                @foreach($secondary_details->employee_details as $employment)
                                 
                                    <tr>                                
                                            
                                            <td><input type="text" class="form-control organziation" value="{{$employment['organziation']}}"   placeholder="Organization"></td>
                                            <td><input type="text" class="form-control designation"  value="{{$employment['designation']}}" placeholder="Designation"></td>
                                            <td><input type="text" class="form-control workperiod" value="{{$employment['workperiod']}}" data-inputmask="'mask': '9999 to 9999'" placeholder="Period of Work"></td>                                                                                      
                                            <td><input type="text" class="form-control duration" value="{{$employment['duration']}}"  placeholder="Total Duration"></td>
                                            <td><input type="text" class="form-control description" value="{{$employment['description']}}"  placeholder="Job Description"></td>
                                            <td><input type="text" class="form-control grosssalary" value="{{$employment['grosssalary']}}"  placeholder="Gross Salary"></td>
                                            <td><span><i class="fa fa-plus empplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash empremoveevent" aria-hidden="true"></i></span></td>
                                    </tr>                             

                                        @endforeach
                                @endif                                
                            @endforeach    
                            @endif
                            
                                <tr>                                         
                                            <td><input type="text" class="form-control organziation"    placeholder="Organization"></td>
                                            <td><input type="text" class="form-control designation"  placeholder="Designation"></td>
                                            <td><input type="text" class="form-control workperiod"  data-inputmask="'mask': '9999 to 9999'" placeholder="Period of Work"></td>                                                                                      
                                            <td><input type="text" class="form-control duration"  placeholder="Total Duration"></td>
                                            <td><input type="text" class="form-control description"  placeholder="Job Description"></td>
                                            <td><input type="text" class="form-control grosssalary"  placeholder="Gross Salary"></td>
                                            <td><span><i class="fa fa-plus empplusevent" aria-hidden="true"></i></span></td>
                                    </tr>
                                      
                                </tbody>               
                            </table>    
                          <div class="card">
                              <div class="card-header" id="headingThree" style="background-color:#844484">
                                <h5 class="mb-0">    Previous Compensation Structure            </h5>
                              </div>
                              <div class="card-body">
                                <table class="table  table-striped table-bordered">
                                  <thead>
                                      <tr>                                
                                          <td>Component</td>
                                          <td>Monthly</td>
                                          <td>Annual</td>                                      
                                      </tr>
                                  </thead>
                                  <tbody id="">
                                      <tr>                                
                                              <td>Basic</td>
                                              <td><input type="text" class="form-control" id="basic_cs_mon" value="{{ $employee_joining->basic_cs_mon }}" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="basic_cs_ann"  value="{{ $employee_joining->basic_cs_ann }}" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>DA</td>
                                              <td><input type="text" class="form-control" id="da_cs_mon"  value="{{ $employee_joining->da_cs_mon }}" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="da_cs_ann" value="{{ $employee_joining->da_cs_ann }}" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Allowances</td>
                                              <td><input type="text" class="form-control" id="allowance_cs_mon" value="{{ $employee_joining->allowance_cs_mon }}" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="allowance_cs_ann"  value="{{ $employee_joining->allowance_cs_ann }}" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Monthly Gross</td>
                                              <td><input type="text" class="form-control" id="monthlygross_cs_mon" value="{{ $employee_joining->monthlygross_cs_mon }}" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="monthlygross_cs_ann" value="{{ $employee_joining->monthlygross_cs_ann }}" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Total Annual Benefits</td>
                                              <td><input type="text" class="form-control" id="annualbene_cs_mon" value="{{ $employee_joining->annualbene_cs_mon }}" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="annualbene_cs_ann" value="{{ $employee_joining->annualbene_cs_ann }}" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Others</td>
                                              <td><input type="text" class="form-control" id="others_cs_mon" value="{{ $employee_joining->others_cs_mon }}" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="others_cs_ann" value="{{ $employee_joining->others_cs_ann }}" placeholder="Annual"></td>                                         
                                      </tr>
                                  </tbody>               
                                </table>    
                              </div>
                          </div>
                        </div> 
                        <button type="button" class="btn btn-primary" id="save_employment_details" style="float:right">Save Employment Details</button> 
                  </div>
           </div>          
            <div class="card">
                  <button class="btn btn-link collapsed btncolor" data-toggle="collapse" data-target="#collapsefour" aria-expanded="false" aria-controls="collapsefour">
                    <div class="card-header" id="headingThree">
                    <h6 class="mb-0" style="text-align:left">             
                                      Other Information                  
                      </h6>
                    </div>
                   </button>  
                  <div id="collapsefour" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                          <div class="card-body">                       
                            <table class="table " id="otherscheckevent">
                              <tbody>
                                <tr>
                                    <td>1. Whether attended interview with Nash Industries previously If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="previous_employee" class="checkboxchecked" {{ $employee_joining->previous_employee == 'Yes'?'Checked':'' }}><span class="slider round"></span></label></td>                                   
                                </tr>
                                <tr id="extrainfoprevious_employee" style="display: {{ $employee_joining->previous_employee_details != ''?'':'none' }}">
                                    <td><textarea class="form-control" id="previous_employee_details" rows="3" placeholder="Enter text..">{{ $employee_joining->previous_employee_details }}</textarea></td>
                                </tr>
                                <tr>
                                    <td>2) Do you have any relatives working in this organization Yes/ No If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="relative_working" class="checkboxchecked" {{ $employee_joining->relative_working == 'Yes'?'Checked':'' }}><span class="slider round"></span></label></td>
                                </tr>
                                <tr  id="extrainforelative_working" style="display: {{ $employee_joining->relative_working_details != ''?'':'none' }}">
                                    <td><textarea class="form-control" id="relative_working_details" rows="3" placeholder="Enter text.."> {{ $employee_joining->relative_working_details }}</textarea></td>
                                </tr>
                                <tr>
                                    <td>3) Had you suffered any major illness or were hospitalized for operation Yes/ No If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="major_illness" class="checkboxchecked" {{ $employee_joining->major_illness == 'Yes'?'Checked':'' }}><span class="slider round"></span></label></td>
                                </tr>
                                <tr  id="extrainfomajor_illness" style="display: {{ $employee_joining->major_illness_details != ''?'':'none' }}">
                                    <td><textarea class="form-control" id="major_illness_details" rows="3" placeholder="Enter text..">{{ $employee_joining->major_illness_details}}</textarea></td>
                                </tr>
                                <tr>
                                    <td>4) Had you ever been convicted by any Court of Law in India Yes/ No If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="any_court_law" class="checkboxchecked" {{ $employee_joining->any_court_law == 'Yes'?'Checked':'' }}><span class="slider round"></span></label></td>
                                </tr>
                                <tr  id="extrainfoany_court_law" style="display: {{ $employee_joining->any_court_law_details != ''?'':'none' }}">
                                    <td><textarea class="form-control" id="any_court_law_details" rows="3" placeholder="Enter text..">{{ $employee_joining->any_court_law_details }}</textarea></td>
                                </tr>
  
                              </tbody>
                            </table>

                          </div>
                          <button type="button" id="save_other_information" class="btn btn-primary" style="float:right">Save Details</button> 
                    </div>                        
            </div>
@endif           

            <div class="card">
                  <button class="btn btn-link collapsed btncolor" data-toggle="collapse" data-target="#collapsefive" aria-expanded="false" aria-controls="collapsefive">
                    <div class="card-header" id="headingThree">
                    <h6 class="mb-0" style="text-align:left">             
                                     File Uploads            
                      </h6>
                    </div>
                   </button> 
                

                  <div id="collapsefive" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                          <div class="card-body">                       
                          <table class="table  table-striped table-bordered">
                                      <thead>
                                          <tr>                                
                                             <td>File Name</td>
                                              <td>Upload File</td>                                                 
                                              <td>Action</td>                                              
                                          </tr>
                                      </thead>
                                      <tbody id="file_details">
                                         @if(!empty($employee_joining->file_details))
                                             @foreach($employee_joining->file_details as $files)
                                                <tr>    
                                                        <td><input type="text" id="file_name_detail"  class="form-control" placeholder="" value="{{$files['file_name']}}"></td>
                                                        <td><input name="file-upload-field" type="file" class="file-upload-field btn btn-success" value=""><span><a href="{{ asset('storage/HrFiles')}}/{{$files['file_path']}}" download> <i class="fa fa-download" aria-hidden="true"></i></a></span><button Class="btn btn-primary" id="save_filedetails" style="float:right">Save</button></td>
                                                        <td><span><i class="fa fa-plus fileplusevent" aria-hidden="true"></i></span></td>
                                                </tr>
                                             @endforeach
                                        @endif
                                          <tr>    
                                                  <td><input type="text" id="file_name_detail" class="form-control" placeholder="10th Marksheet"></td>
                                                  <td><input name="file-upload-field" type="file" class="file-upload-field btn btn-success" value=""><button Class="btn btn-primary" id="save_filedetails" style="float:right">Save</button></td>
                                                  <td><span><i class="fa fa-plus fileplusevent" aria-hidden="true"></i></span></td>
                                          </tr>
                                      </tbody>               
                                  </table>                     
                          </div>
                          
                    </div> 
                        
                  </div>
            </div>

            




  </div>           
  </section>     
  

</div>
@endsection
@push('scripts')

<script type="text/javascript" src="{{ URL::asset('js/personaldetail.js') }}"></script>

@endpush