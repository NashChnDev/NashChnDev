@extends('layouts.app')

@section('page-title','Device Requests List')

@section('content')
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
            <style>
      
  /* #first_header{
    font-size: 12px;
    font-family: -webkit-body;    
    color: #4a3d69;
  } */
  /* #first_header input{
      border: none;
      border-bottom: 1px solid #d6d4da;
      background-color: #ffffff;
  } */
  /* #first_header select{
      border: none;
      border-bottom: 1px solid #d6d4da;
      background-color: #ffffff;
  }
  #first_header textarea{
      border: none;
      border-bottom: 1px solid #d6d4da;
      background-color: #ffffff;
  }   */
.btncolor{
    color:white !important;
    
}
.btncolor:hover{
    color:white !important;
}


#profileimage .profile-pic {
    max-width: 115px;
    max-height: 200px;
    display: block;
}

#profileimage .file-upload {
    display: none;
}
#profileimage .circle {
    border-radius: 1000px !important;
    overflow: hidden;
    width: 128px;
    height: 128px;
    border: 8px solid rgba(241, 232, 232, 0.7);
    position: absolute;
    /* top: 72px; */
}
#profileimage img {
    max-width: 100%;
    height: auto;
}
#profileimage .p-image {
  position: absolute;
  top: 100px;
  right: 30px;
  color: #666666;
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
}
#profileimage .p-image:hover {
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
}
#profileimage .upload-button {
  font-size: 1.2em;
}

#profileimage .upload-button:hover {
  transition: all .3s cubic-bezier(.175, .885, .32, 1.275);
  color: #999;
}
.tableborder >thead>tr{
    width:100%;
}
#TextBoxContainer span i{
    font-size: 13px;
    padding: 3px;
    margin: 0px;    
    color: indianred;
}
#education_details span i{
    font-size: 13px;
    padding: 3px;
    margin: 0px;    
    color: indianred;
}
.switch {
  position: relative;
  display: inline-block;
  width: 60px;
  height: 34px;
}

.switch input { 
  opacity: 0;
  width: 0;
  height: 0;
}

.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #ccc;
  -webkit-transition: .4s;
  transition: .4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 26px;
  width: 26px;
  left: 4px;
  bottom: 4px;
  background-color: white;
  -webkit-transition: .4s;
  transition: .4s;
}

input:checked + .slider {
  background-color: #2196F3;
}

input:focus + .slider {
  box-shadow: 0 0 1px #2196F3;
}

input:checked + .slider:before {
  -webkit-transform: translateX(26px);
  -ms-transform: translateX(26px);
  transform: translateX(26px);
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.slider.round:before {
  border-radius: 50%;
}


.inputs{
   position:relative;
   float:left;
   width:100%;
   
   box-sizing:border-box;
   padding:5px 0px 5px 10px;
}
/* .inputs.half{ width:50%; } */

.inputs input {
   width:100%;
   padding:20px 0px 4px 0px;
   background:transparent;
   
   box-sizing:border-box;
   border-color: #f1e5e5;
   border-width: 0px 0px 2px 0px;
  
   outline:none;
   transition:all 0.3s;
   padding:0px 15x;
}

.inputs input:focus{
   border-bottom:2px solid #FFF;
}
.inputs input + label:after{
   content: " ";
}
.inputs input:placeholder-shown + label{
   color:#612529;
   left:13px;
   bottom:-8px;
}
.inputs input:focus + label,
.inputs input + label{
   position:absolute;
   bottom:14px;
   left:10px;
   color:#612529;
   line-height:60px;
   pointer-events:none;
   transition: all 0.25s;
   font-size:16px;
}

.inputs textarea {
   width:100%;
   padding:20px 0px 4px 0px;
   background:transparent;
   
   box-sizing:border-box;
   border-color: #f1e5e5;
   border-width: 0px 0px 2px 0px;
  
   outline:none;
   transition:all 0.3s;
   padding:0px 15x;
}

.inputs textarea:focus{
   border-bottom:2px solid #FFF;
}
.inputs textarea + label:after{
   content: " ";
}
.inputs textarea:placeholder-shown + label{
   color:#612529;
   left:13px;
   bottom:-8px;
}
.inputs textarea:focus + label,
.inputs textarea + label{
   position:absolute;
   bottom:14px;
   left:10px;
   color:#612529;
   line-height:60px;
   pointer-events:none;
   transition: all 0.25s;
   font-size:16px;
}

.inputs select {
   width:100%;
   padding:14px 0px 0px 0px;
   background:transparent;   
   box-sizing:border-box;
   border-color: #f1e5e5;
   border-width: 0px 0px 2px 0px;
  
   outline:none;
   transition:all 0.3s;
   padding:0px 15x;
}
label{
    font-size: 16px;
    color: #612529;
    font-weight: normal !important;
}


</style>
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
             <input type="hidden" id="temp_id" value="{{ $employee_joining['id'] }}">
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
                        <img class="profile-pic" src="{{URL::asset('/img/avatar04.png')}}" height="200" width="200">

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
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="TextBoxContainer">
                            @if($employee_joining->secondary_details != null)
                            @foreach($employee_joining->secondary_details as $secondary_details)
                                @if($secondary_details.type_of == 'Family')
                                @foreach($secondary_details['employee_details'] as $family)
                                <tr>                                
                                        <td><input type="text" class="form-control names" value="{{$family['name']}}" placeholder="Name"></td>
                                        <td><input type="text" class="form-control relationship"   value="{{$family['relationship']}}" placeholder="Relationship"></td>
                                        <td><input type="text" class="form-control age"    value="{{$family['age']}}" placeholder="Age"></td>
                                        <td><input type="text" class="form-control education"  value="{{$family['education']}}" placeholder="Education"></td>
                                        <td><input type="text" class="form-control occuption"  value="{{$family['occuption']}}"  placeholder="Occuption"></td>
                                        <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash removeevent" aria-hidden="true"></i></span></td>
                                </tr>
                                @endif
                                @endforeach
                            @endforeach    
                            @endif
                                <tr>                                
                                        <td><input type="text" class="form-control names"   placeholder="Name"></td>
                                        <td><input type="text" class="form-control relationship"   placeholder="Relationship"></td>
                                        <td><input type="text" class="form-control age"   placeholder="Age"></td>
                                        <td><input type="text" class="form-control education"   placeholder="Education"></td>
                                        <td><input type="text" class="form-control occuption"  placeholder="Occuption"></td>
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

                                      <!-- @if($employee_joining->secondary_details != null && $employee_joining->secondary_details['type_of'] == 'Education' && !empty($employee_joining->secondary_details['employee_details']['education']))
                                            @foreach($employee_joining->secondary_details['employee_details']['education'] as $education)
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
                                        @endif -->
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
                                    <!-- @if($employee_joining->secondary_details != null && $employee_joining->secondary_details['type_of'] == 'Education' && !empty($employee_joining->secondary_details['employee_details']['training']))
                                            @foreach($employee_joining->secondary_details['employee_details']['training'] as $trainings)
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
                                        @endif -->
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
                              <!-- @if($employee_joining->secondary_details != null && $employee_joining->secondary_details['type_of'] == 'Education' && !empty($employee_joining->secondary_details['employee_details']['computer']))
                                            @foreach($employee_joining->secondary_details['employee_details']['computer'] as $computers)
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
                                        @endif -->
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


           <div class="card">
            <button class="btn btn-link collapsed btncolor" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                <div class="card-header" id="headingThree">
                <h6 class="mb-0" style="text-align:left">                       Employment Details               
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
                                <!-- @if($employee_joining->secondary_details != null && $employee_joining->secondary_details['type_of'] == 'employment')
                                     @foreach($employee_joining->secondary_details['employee_details'] as $employment)
                                
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
                                        @endif -->
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
                                      <!-- @if($employee_joining->file_details != null)
                                          <tr>    
                                                  <td><input type="text" id="file_name_detail"  class="form-control" placeholder="" value="{{$employee_joining->file_details['file_name']}}"></td>
                                                  <td><input name="file-upload-field" type="file" class="file-upload-field btn btn-success" value=""><span><a href="{{ asset('storage/HrFiles')}}/{{$employee_joining->file_details['file_path']}}" download> <i class="fa fa-download" aria-hidden="true"></i></a></span><button Class="btn btn-primary" id="save_filedetails" style="float:right">Save</button></td>
                                                  <td><span><i class="fa fa-plus fileplusevent" aria-hidden="true"></i></span></td>
                                          </tr>
                                      @endif -->
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

<script>

function checkpersonal(){
    return true;
}
$(document).ready(function(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        $('body').on('click',"#save_personal_details",function(e){
                        e.preventDefault();             
                        var tempid = $("#temp_id").val();
                        var data = {};
                        data.name = $("#name").val();
                        data.date_birth = $("#date_birth").val();
                        data.blood_group = $("#blood_group").val();
                        data.Mobile_no = $("#Mobile_no").val();
                        data.Mobile_no_secondary = $("#Mobile_no_secondary").val();
                        data.present_address = $("#present_address").val(); 
                        data.email = $("#email").val();
                        data.gender = $("#gender").val();
                        data.martial_status = $("#martial_status").val();
                        data.religion = $("#religion").val();
                        data.language_known = $("#language_known").val();
                        data.permanent_address = $("#permanent_address").val();
                        var secondary_data = {};
                        secondary_data.type_of = 'Family';
                        secondary_data.temp_empid = $("#temp_id").val();
                        secondary_data.employee_details =[];
                        $("#TextBoxContainer > tr").each(function(index,tr){                         
                                var temp = {};
                                temp.name = $(this).find(".names").val();
                                temp.relationship = $(this).find(".relationship").val();
                                temp.age = $(this).find(".age").val();
                                temp.education = $(this).find(".education").val();
                                temp.occuption = $(this).find(".occuption").val();
                                if(temp.name != '' && temp.name != null){
                                    secondary_data.employee_details.push(temp);
                                }                
                        });
                        if(secondary_data.employee_details.length == 0){
                            secondary_data = null;
                        }
                        if(checkpersonal(data)){                  
                            $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            data:{primary:data,secondary:secondary_data,tempid:tempid,type_of:'Family'},
                            success:function(res){
                                if(res.Success == 'Success'){
                                    $.message({
                                            type: "success",
                                            text: "Successfully updated",
                                            duration: 5000,
                                            positon: "top-center",
                                            showClose: true
                                    });
                                }

                            }
                            });
                        }        
    });
    $('body').on('click',"#save_education_details",function(e){
                    e.preventDefault();             
                    var tempid = $("#temp_id").val();
                    var secondary_data = {};
                    secondary_data.type_of = 'Education';
                    secondary_data.temp_empid = $("#temp_id").val();
                    secondary_data.employee_details ={};
                    secondary_data.employee_details['education'] =[]; 
                    secondary_data.employee_details['training'] =[]; 
                    secondary_data.employee_details['computer'] =[];                     
                    $("#education_details > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.course = $(this).find(".course").val();
                        temp.subject = $(this).find(".subject").val();
                        temp.institute = $(this).find(".institute").val();
                        temp.duration = $(this).find(".duration").val();
                        temp.passing = $(this).find(".passing").val();
                        temp.cgpa = $(this).find(".cgpa").val();                        
                        if(temp.course != '' && temp.course != null){
                            secondary_data.employee_details['education'].push(temp);
                        }                
                    });
                    $("#training_details > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.training = $(this).find(".training").val();
                        temp.programme = $(this).find(".programme").val();
                        temp.institute = $(this).find(".institute").val();
                        temp.duration = $(this).find(".duration").val();                                              
                        if(temp.training != '' && temp.training != null){
                            secondary_data.employee_details['training'].push(temp);
                        }                
                    });
                    $("#computer_knowledge > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.cpk = $(this).find(".cpk").val();
                        temp.application = $(this).find(".application").val();
                        temp.knowledge = $(this).find(".knowledge").val();                                                               
                        if(temp.cpk != '' && temp.cpk != null){
                            secondary_data.employee_details['computer'].push(temp);
                        }                
                    });
                   
                    
                    if(secondary_data.employee_details.education.length == 0 && secondary_data.employee_details.training.length == 0 && secondary_data.employee_details.computer.length == 0){
                        secondary_data = null;                        
                    }    
                    // }else{
                    //     console.log(secondary_data.employee_details);
                    //     secondary_data.employee_details = JSON.stringify(secondary_data.employee_details);
                    // }
                    if(checkpersonal(secondary_data)){                  
                        $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            dataType:'json',
                            data:{secondary:secondary_data,tempid:tempid,type_of:'Education'},
                            success:function(res){
                            if(res.Success == 'Success'){
                                $.message({
                                type: "success",
                                text: "Successfully updated",
                                duration: 5000,
                                positon: "top-center",
                                showClose: true
                                });
                            }

                        }
                        });
                    }
    });
    $('body').on('click',"#save_employment_details",function(e){
                e.preventDefault();             
                var tempid = $("#temp_id").val();
                var data = {};
                var secondary_data = {};
                        secondary_data.type_of = 'employment';
                        secondary_data.temp_empid = $("#temp_id").val();
                        secondary_data.employee_details =[];
                $("#employment_details > tr").each(function(index,tr){                         
                        var temp = {};
                        temp.organziation = $(this).find(".organziation").val();
                        temp.designation = $(this).find(".designation").val();
                        temp.workperiod = $(this).find(".workperiod").val();
                        temp.duration = $(this).find(".duration").val();
                        temp.description = $(this).find(".description").val();
                        temp.grosssalary = $(this).find(".grosssalary").val();                        
                        if(temp.organziation != '' && temp.organziation != null){
                            secondary_data.employee_details.push(temp);
                        }     
                });
                data.basic_cs_mon = $("#basic_cs_mon").val();
                data.basic_cs_ann = $("#basic_cs_ann").val();
                data.da_cs_mon = $("#da_cs_mon").val();
                data.da_cs_ann = $("#da_cs_ann").val();
                data.allowance_cs_mon = $("#allowance_cs_mon").val();
                data.allowance_cs_ann = $("#allowance_cs_ann").val();
                data.monthlygross_cs_mon = $("#monthlygross_cs_mon").val();
                data.monthlygross_cs_ann = $("#monthlygross_cs_ann").val();
                data.annualbene_cs_mon = $("#annualbene_cs_mon").val();
                data.annualbene_cs_ann = $("#annualbene_cs_ann").val();
                data.others_cs_mon = $("#others_cs_mon").val();
                data.others_cs_ann = $("#others_cs_ann").val();
                if(checkpersonal(data)){                  
                        $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            dataType:'json',
                            data:{primary:data,secondary:secondary_data,tempid:tempid,type_of:'employment'},
                            success:function(res){
                            if(res.Success == 'Success'){
                                $.message({
                                type: "success",
                                text: "Successfully updated",
                                duration: 5000,
                                positon: "top-center",
                                showClose: true
                                });
                            }

                        }
                        });
                    }
    });
    $('body').on('click','#save_other_information',function(e){
                e.preventDefault();             
                var tempid = $("#temp_id").val();
                var data = {};
                $('#otherscheckevent').find(".checkboxchecked").each(function(){                   
                    if($(this).is(":checked")){  
                        var idinfo = $(this).attr('id');                       
                        data[idinfo] = 'Yes';                        
                        var extrainfo = $(this).attr('id')+'_details';
                        if($("#"+extrainfo).val() != ''){
                            data[extrainfo] = $("#"+extrainfo).val();
                        }                        
                    }
                    else if($(this).is(":not(:checked)")){
                        var idinfo = $(this).attr('id');
                        console.log(idinfo);
                        data[idinfo] = 'No';                      
                    }
                });
                if(checkpersonal(data)){                  
                        $.ajax({
                            type:'POST',
                            url:'storepersonaldetail',
                            dataType:'json',
                            data:{primary:data,tempid:tempid,type_of:'others'},
                            success:function(res){
                            if(res.Success == 'Success'){
                                $.message({
                                type: "success",
                                text: "Successfully updated",
                                duration: 5000,
                                positon: "top-center",
                                showClose: true
                                });
                            }

                        }
                        });
                    }                

    });
    $('body').on('click','#save_filedetails',function(e){
        e.preventDefault();             
                var tempid = $("#temp_id").val();                
                let formData = new FormData();
                let file = $(this).closest('tr').find('input[type=file]')[0].files[0];
                let filename = $(this).closest('tr').find('#file_name_detail').val();
                formData.append('tempid',tempid);
                formData.append('filename', filename);
                formData.append('file', file, file.name);
                $.ajax({
                url: 'storefiledetail',
                headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                type: 'POST',   
                contentType: false,
                processData: false,   
                cache: false,        
                data: formData,
                success: function(res) {
                    if(res.Success == 'Success'){
                                    $.message({
                                            type: "success",
                                            text: "Successfully updated",
                                            duration: 5000,
                                            positon: "top-center",
                                            showClose: true
                                    });
                                }
                },
                error: function(data) {
                    console.log(data);
                }
            });
    });
    

    
                $('.datepicker').datepicker({ dateFormat: 'yy-mm-dd' });
                $(":input").inputmask();
                $('#dob').on('change', function(ev){
                    $(this).datepicker('hide');
                });

                /** toggle Event */
                $('.checkboxchecked').click(function(){                  
                    if($(this).is(":checked")){                        
                        $("#extrainfo"+$(this).attr('id')).show();
                    }
                    else if($(this).is(":not(:checked)")){
                      $("#extrainfo"+$(this).attr('id')).hide();                        
                    }
                });
                /** End Toggle event*/

                /** Uploadevent */                    
                var readURL = function(input) {
                    if (input.files && input.files[0]) {
                        var reader = new FileReader();

                        reader.onload = function (e) {
                            $('.profile-pic').attr('src', e.target.result);
                        }

                        reader.readAsDataURL(input.files[0]);
                    }
                }
                $(".file-upload").on('change', function(){
                    readURL(this);
                });

                $(".upload-button").on('click', function() {
                $(".file-upload").click();
                });
                /** End Upload event */

                /** Add Event */
                function GetDynamicTextBox(value) {
                     return `<tr><td><input type="text" class="form-control names"  placeholder="Name"></td>
                                    <td><input type="text" class="form-control relationship"  placeholder="Relationship"></td>
                                    <td><input type="text" class="form-control age"   placeholder="Age"></td>
                                    <td><input type="text" class="form-control education" placeholder="Education"></td>
                                    <td><input type="text" class="form-control occuption"   placeholder="Occuption"></td>
                                    <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash removeevent" aria-hidden="true"></i></span></td>
                            </tr>`;
                }
                
                $("body").on("click",".plusevent",function () {
                    console.log('hi');
                    var div = GetDynamicTextBox();
                    $("#TextBoxContainer").append(div);
                });
                $("body").on("click", ".removeevent", function () {
                    $(this).closest("tr").remove();
                });                
                /** End Event */

                /** EducationDetail Event */
                function educationtextbox(value) {
                     return `<tr> 
                     <td><input type="text" class="form-control course"  placeholder="BE"></td>
                                                  <td><input type="text" class="form-control subject"  placeholder="Major Subject"></td>
                                                  <td><input type="text" class="form-control institute"  placeholder="Institute/Board/University"></td>                                                  
                                                  <td><input type="text" class="form-control duration" data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                                  
                                                  <td><input type="text" class="form-control passing"  placeholder="Year of Passing"></td>
                                                  <td><input type="text" class="form-control cgpa"  placeholder="Percentage/CGPA"></td>                                                  
                                          <td><span><i class="fa fa-plus eduplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash eduremoveevent" aria-hidden="true"></i></span></td>
                                  </tr>`;
                }

                $("body").on("click",".eduplusevent",function () {
                    console.log('edu');
                    var div = educationtextbox();
                  
                    $("#education_details").append(div);
                    $(".duration").inputmask();
                });
                $("body").on("click", ".eduremoveevent", function () {
                    $(this).closest("tr").remove();
                }); 
                
                /** End Event */

                /** EducationDetail Event */
                function trainingtextbox(value) {
                     return `<tr>                                
                                          
                                          <td><select class="form-control training"><option value="">Select Option</option><option value="App">Apprentice/In-Plant</option><option value="PP">Professional</option></select></td>
                                          <td><input type="text" class="form-control programme"  placeholder="Programme"></td>
                                          <td><input type="text" class="form-control institute"  placeholder="Institute"></td>                                          
                                          <td><input type="text" class="form-control duration"  data-inputmask="'mask': '9999 to 9999'"  placeholder="Duration"></td>                                          
                                          <td><span><i class="fa fa-plus trainingplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash trainingremoveevent" aria-hidden="true"></i></span></td>
                                  </tr>`;
                }

                $("body").on("click",".trainingplusevent",function (e) {
                    console.log('hi');
                    var div = trainingtextbox();                    
                    $("#training_details").append(div);
                    $(".duration").inputmask();
                    
                });
                $("body").on("click", ".trainingremoveevent", function () {
                    $(this).closest("tr").remove();
                }); 
                
                /** End Event */


                /** Employment event*/

                function employmenttextbox(value)
                {
                  return `<tr>                
                                          
                                            <td><input type="text" class="form-control organziation"   placeholder="Organization"></td>
                                            <td><input type="text" class="form-control designation"   placeholder="Designation"></td>
                                            <td><input type="text" class="form-control workperiod" data-inputmask="'mask': '9999 to 9999'" placeholder="Period of Work"></td>                                                                                      
                                            <td><input type="text" class="form-control duration"   placeholder="Total Duration"></td>
                                            <td><input type="text" class="form-control description"   placeholder="Job Description"></td>
                                            <td><input type="text" class="form-control grosssalary"   placeholder="Gross Salary"></td>
                                          <td><span><i class="fa fa-plus empplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash empremoveevent" aria-hidden="true"></i></span></td>
                                  </tr>`;
                }
                $("body").on("click",".empplusevent",function () {                    
                    var div = employmenttextbox();
                    $("#employment_details").append(div);
                    $(":input").inputmask();
                });
                $("body").on("click", ".empremoveevent", function () {
                    $(this).closest("tr").remove();
                }); 

                 /** End Event*/      

                 /** Computer Knowledge */     
                 function computerknowledge(value)
                {
                  return `<tr>            <td><select class="form-control cpk"><option value="">Select Option</option> <option value="Mso">MS Office(Word; Excel; Power Point)</option>
                                              <option value="erp">ERP</option>
                                              <option value="ds">Designing Software</option>
                                              <option value="os" >Others, Specify</option></select></td>
                                          <td><input type="text" class="form-control application"></td>
                                          <td>
                                          <select class="form-control knowledge">
                                                <option value="kob">Know only Basic</option>
                                                <option value="hws">Has Working Skils</option>
                                                <option value="iw">Independently Work</option>
                                                <option value="exp">Expert</option>
                                          </select>
                                          </td>
                                          <td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash ckevent" aria-hidden="true"></i></span></td>
                                  </tr>    `;
                }
                $("body").on("click",".ckplusevent",function () {                    
                    var div = computerknowledge();
                    $("#computer_knowledge").append(div);                    
                });
                $("body").on("click", ".ckevent", function () {
                    $(this).closest("tr").remove();
                }); 

                /** End CK */  

                /** File Uploads */

                function fileuploads(value)                {
                  return `<tr>  
                                                  <td><input type="text" class="form-control" placeholder="10th Marksheet"></td>
                                                  <td><input name="file-upload-field" type="file" class="file-upload-field btn btn-success" value=""> <button Class="btn btn-primary" style="float:right">Save</button>                                   </td>
                                                  <td><span><i class="fa fa-plus fileplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash ckremoveevent" aria-hidden="true"></i></span></td>
                                          </tr>`;
                }
                $("body").on("click",".fileplusevent",function () {                    
                    var div = fileuploads();
                    $("#file_details").append(div);                    
                });
                $("body").on("click", ".ckremoveevent", function () {
                    $(this).closest("tr").remove();
                }); 

                /**End File Uploads */
    });
</script>

@endpush