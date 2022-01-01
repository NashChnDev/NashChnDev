@extends('layouts.guest')
@section('content')
<link rel="stylesheet" href="{{ URL::asset('css/nashemployee.css') }}" />
<style>
    .headercol{
        top:0px !important
    }
    @media all and (max-width: 720px) {
    .headercol {
       
        top: 0px !important
    }
    #nash_joiningform {
        margin-top: 327px !important;
    }
  
}
    </style>
        <!-- Content Wrapper. Contains page content -->
        {{-- <div class="content-wrapper" id="nashemployee" style="background-color: white">          --}}
         {{-- <div class="row"> --}}
            <div class="col-md-10 offset-md-1 headercol">  
              <div class="row">
                <div class="col-4 d-md-block col-md-4 ">
                  <ul>                  
                    {{-- <li ><strong style="padding:5px">Basic Details</strong></li> --}}
                    <li><h3><strong>@if(!empty($basic)){{ $basic['name'] }}@endif</strong></h3></li>
                    <li><h6>@if(!empty($basic)){{ $basic['designation'] }} @endif at @if(!empty($basic)){{ $location[0]['location'] }} @endif</h6></li>

                    <li>
                      <ul class="sub-basic">
                        <li><h6 class="fifty" id="emp_id">EmpCode*</h6></li>
                        <li><h6 class="fifty" id="header_mobile"></h6></li>
                        <li><h6 id="header_email"></h6></li>
                      </ul>                                       
                    </li>                      
                  </ul>
                </div>
                <div class="col-4 d-md-block col-md-4">
                  
                  <div  id="profileimage">
                    <div class="">
                        <div class="circle">
                              <img class="profile-pic" src="{{URL::asset('/img/avatar04.png')}}" height="200" width="200">
                        </div>
                        <div class="p-image">
                        <i class="fa fa-camera upload-button"></i>
                            <input class="file-upload" type="file" accept="image/*"/>
                        </div>
                    </div>
                  </div>
                </div>
                <div class="col-4 d-md-block  col-md-4">
                  <div class="card-body bg-primary pendingaction">
                    <h2 class="card-title"><strong>Pending Details</strong> </h2>
                    <ul id="pending_details">
                     
                    </ul>
                   
                  </div>
                </div>
                </div>
              </div>
            </div>            
            <div class="col-md-3 d-xs-none d-sm-none d-md-block side_quick_link" style="">
              <div class="affix d-none d-md-block">
                <div class="card mb-3 col-md-11 offset-md-1 d-none d-md-block"  >
                  <div class="card-body quicklink bg-primary">
                    <span><h5><strong>Quick Links</strong></h5></span>
                    <ul>
                      <li id="personal"><i class="fa fa-male" aria-hidden="true"></i><strong>Personal Details</strong><li>
                      <li id="education"><i class="fa fa-book" aria-hidden="true"></i><strong>Education Details</strong><li>
                          <li id="employment"><i class="fa fa-user-md" aria-hidden="true"></i><strong>Employment Details</strong><li>
                            <li id="skillset"><i class="fa fa-user-md" aria-hidden="true"></i><strong>Skill Details</strong><li>                          
                              <li id="otherdetails"><i class="fa fa-joomla" aria-hidden="true"></i><strong>Other Details</strong><li>
                    </ul>
                  
                  </div>
                </div>   
              </div>
            </div>     
            <div class="col-md-8 offset-md-3" id="nash_joiningform" style="">
                  <div class="card  mb-3 col-xs- 11 col-sm-11 col-md-11 offset-md-1" id="personal_section" >
                    <div class="">
                      <h5 class="card-title" style="cursor:pointer" id="personal_modal_edit"><strong>Personal Details</strong><i class="fa fa-pencil" aria-hidden="true"></i></h5>
                      <div class="bodys">

                      </div>
                    </div>                  
                  </div>

            

              <div class="card  mb-3 col-md-11 offset-md-1"   id="education_section">
                
                <div class="">
                  <h5 class="card-title" style="cursor:pointer" id="education_modal_edit"><strong>Education Details</strong><i class="fa fa-pencil" aria-hidden="true"></i></h5>
                  <div class="edubodys">

                  </div>
                </div>
              </div>
              <div class="card  mb-3 col-md-11 offset-md-1"  id="employment_section" >              
                <div class="">
                  <h5 class="card-title" style="cursor:pointer" id="employment_modal_edit"><strong>Employment Details</strong><i class="fa fa-pencil" aria-hidden="true"></i></h5>
                  <div class="empbodys">

                  </div>
                </div>
              </div>
              <div class="card  mb-3 col-md-11 offset-md-1"   id="skillset_section">
                
                <div class="">
                  <h5 class="card-title" style="cursor:pointer" id="skill_modal_edit"><strong>Skill Details</strong><i class="fa fa-pencil" aria-hidden="true"></i></h5>
                  <div class="skillbodys">

                  </div>
                </div>
              </div>
              <div class="card  mb-3 col-md-11 offset-md-1" id="otherdetails_section"  >
                
                <div class="card-body">
                  <h5 class="card-title"style="cursor:pointer" id="other_modal_edit"><strong>Other Details</strong><i class="fa fa-pencil" aria-hidden="true"></i></h5>
                  <p class="card-text"></p>
                </div>
              </div>           
            </div>
            
         </div> 

        {{-- </div>  --}}
         
        {{-- </div> --}}
      
        <div class="modal" id="persModal"  role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="">Personal details</h5>
                <button type="button" class="close modalclose" >
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body" >      
                  
              </div>            
            </div>
          </div>
        </div>
          @push('scripts')
          <script>
            var personaldetail = new joiningPersonal('joiningform','@json($basic)','@json($country)');  
          </script>
          @endpush
@endsection
  