@extends('layouts.guest')
@section('content')
<div class="">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0 text-dark">Employee Details</h1>
                        </div><!-- /.col -->
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                           
                            </ol>
                        </div><!-- /.col -->
                </div><!-- /.row -->
             </div><!-- /.container-fluid -->
        </div>
            <style>
  #first_header{
    font-size: 12px;
    font-family: -webkit-body;    
    color: #4a3d69;
  }
  #first_header input{
      border: none;
      border-bottom: 1px solid #d6d4da;
      background-color: #ffffff;
  }
  #first_header textarea{
      border: none;
      border-bottom: 1px solid #d6d4da;
      background-color: #ffffff;
  }  
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
                <div class=" col-sm-12 col-xs-12 col-md-5">
                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="Name*">

                         <!-- <input id="cc" type="text" data-inputmask="'mask': '9999 9999 9999 9999'" />  </div> -->
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control datepicker" id="dob" aria-describedby="" placeholder="Date of Birth*">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="BloodGroup*">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="MobileNo*">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="Alternate Phone No*">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                   
                  
                    <div class="form-group">
                        <!-- <label for="exampleFormControlTextarea1">Example textarea</label> -->
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Present Address*"></textarea>
                    </div>

                </div>
                <div class=" col-sm-12 col-xs-12 col-md-5">
                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="EmailID* ">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                   <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="Gender*">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                  <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="Marital Status">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>                 

                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="Religion & Caste">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                    <div class="form-group">
                    <!-- <label for="exampleInputEmail1">Name*</label> -->
                         <input type="text" class="form-control" id="" aria-describedby="" placeholder="Language Known">
                    <!-- <small id="" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
                    </div>
                   
                    <div class="form-group">
                        <!-- <label for="exampleFormControlTextarea1">Example textarea</label> -->
                        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Permanent Address*"></textarea>
                    </div>
                </div>   
                <div class="col-sm-12 col-xs-12 col-md-2 col-lg-2" id="profileimage">
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
                                <td>Age</td>
                                <td>Education</td>
                                <td>Occuption</td>
                                <td>Action</td>
                            </tr>
                        </thead>
                        <tbody id="TextBoxContainer">
                            <tr>                                
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Name"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Relationship"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Age"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Education"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Occuption"></td>
                                    <td><span><i class="fa fa-plus plusevent" aria-hidden="true"></i></span></td>
                            </tr>
                        </tbody>               
                    </table>    
                </div>               
            </div>
            <button type="button" class="btn btn-primary" style="float:right">Save Personal Details</button>
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
                                <table class="table table-striped table-bordered">
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
                                          <tr>                                
                                                  <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="BE"></td>
                                                  <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Major Subject"></td>
                                                  <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Institute/Board/University"></td>                                                  
                                                  <td><input type="text" class="form-control" data-inputmask="'mask': '9999 to 9999'" id="" aria-describedby="" placeholder="Duration"></td>                                                  
                                                  <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Year of Passing"></td>
                                                  <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Percentage/CGPA"></td>
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
                                  <tr>                               
                                          
                                          <td><select class="form-control" id="sel1"><option>Apprentice/In-Plant</option><option>Professional</option></select></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Programme"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Institute"></td>                                          
                                          <td><input type="text" data-inputmask="'mask': '9999 to 9999'" class="form-control" id="" aria-describedby="" placeholder="Duration"></td>                                          
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
                                  <tr>                                
                                        
                                          <td><select class="form-control" id="sel1"><option>MS Office(Word; Excel; Power Point)</option><option>ERP</option><option>Designing Software</option><option>Others, Specify</option></select></td>
                                          <td><input type="text" class="form-control"></td>
                                          <td>
                                          <select class="form-control">
                                                <option>Know only Basic</option>
                                                <option>Has Working Skils</option>
                                                <option>Independently Work</option>
                                                <option>Expert</option>
                                          </select>
                                          </td>
                                          <td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span></td>
                                  </tr>                                
                              </tbody>               
                          </table>    
                    </div>               
                </div>
                <button type="button" class="btn btn-primary" style="float:right">Save Education Details</button>
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
                                    <tr>                                
                                            
                                            <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Organization"></td>
                                            <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Designation"></td>
                                            <td><input type="text" class="form-control" data-inputmask="'mask': '9999 to 9999'" id="" aria-describedby="" placeholder="Period of Work"></td>                                                                                      
                                            <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Total Duration"></td>
                                            <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Job Description"></td>
                                            <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Gross Salary"></td>
                                            <td><span><i class="fa fa-plus empplusevent" aria-hidden="true"></i></span></td>
                                    </tr>
                                </tbody>               
                            </table>    
                          <div class="card">
                              <div class="card-header" id="headingThree" style="background-color:#844484">
                                <h5 class="mb-0">     Previous Compensation Structure            </h5>
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
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>DA</td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Allowances</td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Monthly Gross</td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Total Annual Benefits</td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Annual"></td>                                         
                                      </tr>
                                      <tr>                                
                                              <td>Others</td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Monthly"></td>
                                              <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Annual"></td>                                         
                                      </tr>
                                  </tbody>               
                                </table>    
                              </div>
                          </div>
                        </div> 
                        <button type="button" class="btn btn-primary" style="float:right">Save Employment Details</button> 
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
                            <table class="table ">
                              <tbody>
                                <tr>
                                    <td>1. Whether attended interview with Nash Industries previously If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="previous" class="checkboxchecked"><span class="slider round"></span></label></td>                                   
                                </tr>
                                <tr style="display:none" id="extrainfoprevious">
                                    <td><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter text.."></textarea></td>
                                </tr>
                                <tr>
                                    <td>2) Do you have any relatives working in this organization Yes/ No If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="organization" class="checkboxchecked" ><span class="slider round"></span></label></td>
                                </tr>
                                <tr style="display:none" id="extrainfoorganization">
                                    <td><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter text.."></textarea></td>
                                </tr>
                                <tr>
                                    <td>3) Had you suffered any major illness or were hospitalized for operation Yes/ No If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="hospitalized" class="checkboxchecked"><span class="slider round"></span></label></td>
                                </tr>
                                <tr style="display:none" id="extrainfohospitalized">
                                    <td><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter text.."></textarea></td>
                                </tr>
                                <tr>
                                    <td>4) Had you ever been convicted by any Court of Law in India Yes/ No If Yes, give details</td>
                                    <td><label class="switch"><input type="checkbox" id="courtlaw" class="checkboxchecked"><span class="slider round"></span></label></td>
                                </tr>
                                <tr style="display:none" id="extrainfocourtlaw">
                                    <td><textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="Enter text.."></textarea></td>
                                </tr>
  
                              </tbody>
                            </table>

                          </div>
                          <button type="button" class="btn btn-primary" style="float:right">Save Details</button> 
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
                                          <tr>    
                                                  <td><input type="text" class="form-control" placeholder="10th Marksheet"></td>
                                                  <td><input name="file-upload-field" type="file" class="file-upload-field btn btn-success" value=""><button Class="btn btn-primary" style="float:right">Save</button></td>
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
    $(document).ready(function(){

                $('.datepicker').datepicker();
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
                     return `<tr><td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Name"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Relationship"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Age"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Education"></td>
                                    <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Occuption"></td>
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
                                          
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="BE"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Major Subject"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Institute/Board/University"></td>                                          
                                          <td><input type="text" class="form-control" data-inputmask="'mask': '9999 to 9999'" id="" aria-describedby="" placeholder="Duration"></td>                                          
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Year of Passing"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Percentage/CGPA"></td>
                                          <td><span><i class="fa fa-plus eduplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash eduremoveevent" aria-hidden="true"></i></span></td>
                                  </tr>`;
                }

                $("body").on("click",".eduplusevent",function () {
                    console.log('edu');
                    var div = educationtextbox();
                  
                    $("#education_details").append(div);
                    $(":input").inputmask();
                });
                $("body").on("click", ".eduremoveevent", function () {
                    $(this).closest("tr").remove();
                }); 
                
                /** End Event */

                /** EducationDetail Event */
                function trainingtextbox(value) {
                     return `<tr>                                
                                          
                                          <td><select class="form-control" id="sel1"><option>Apprentice/In-Plant</option><option>Professional</option></select></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Programme"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Institute"></td>                                          
                                          <td><input type="text" class="form-control" id="" data-inputmask="'mask': '9999 to 9999'" aria-describedby="" placeholder="Duration"></td>                                          
                                          <td><span><i class="fa fa-plus trainingplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash trainingremoveevent" aria-hidden="true"></i></span></td>
                                  </tr>`;
                }

                $("body").on("click",".trainingplusevent",function () {
                    console.log('hi');
                    var div = trainingtextbox();
                    $("#training_details").append(div);
                    $(":input").inputmask();
                });
                $("body").on("click", ".trainingremoveevent", function () {
                    $(this).closest("tr").remove();
                }); 
                
                /** End Event */


                /** Employment event*/

                function employmenttextbox(value)
                {
                  return `<tr>                                
                                         
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Organization"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Designation"></td>
                                          <td><input type="text" class="form-control" data-inputmask="'mask': '9999 to 9999'" id="" aria-describedby="" placeholder="Period of Work"></td>                                                                                    
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Total Duration"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Job Description"></td>
                                          <td><input type="text" class="form-control" id="" aria-describedby="" placeholder="Gross Salary"></td>
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
                  return `<tr>                                
                                         
                                          <td><select class="form-control" id="sel1"><option>MS Office(Word; Excel; Power Point)</option><option>ERP</option><option>Designing Software</option><option>Others, Specify</option></select></td>
                                          <td><input type="text" class="form-control"></td>
                                          <td>
                                          <select class="form-control">
                                                <option>Know only Basic</option>
                                                <option>Has Working Skils</option>
                                                <option>Independently Work</option>
                                                <option>Expert</option>
                                          </select>
                                          </td>
                                          <td><span><i class="fa fa-plus ckplusevent" aria-hidden="true"></i></span><span><i class="fa fa-trash ckevent" aria-hidden="true"></i></span></td>
                                  </tr>    `;
                }
                $("body").on("click",".ckplusevent",function () {                    
                    var div = computerknowledge();
                    $("#computer_knowledge").append(div);
                    $(":input").inputmask();
                });
                $("body").on("click", ".ckevent", function () {
                    $(this).closest("tr").remove();
                }); 

                /** End CK */  

                /** File Uploads */

                function fileuploads(value)                {
                  return `<tr>  
                                                  <td><input type="text" class="form-control" placeholder="10th Marksheet"></td>
                                                  <td><input name="file-upload-field" type="file" class="file-upload-field btn btn-success" value=""><button Class="btn btn-primary" style="float:right">Save</button></td>
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