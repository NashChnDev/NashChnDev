@extends('layouts.appplain')



@push('css')
<link href="{{ asset('plugins/icheck/square/blue.css') }}" rel="stylesheet">
@endpush

<!-- @section('body-class','login-page')
@section('page-title','User Login') -->

@section('content')


  <div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>
  <!-- End Page Loading -->
<!-- <img src="{{ asset('img/0.png') }}" alt="Brand Logo" class="brand-image img-circle elevation-3"
           style="opacity: 1">-->
<br>
 

 
  <style>
  @media only screen and (max-width: 600px) {
    .logincss{
      margin-right: 50px !important;
  }
}
@media only screen and (max-width: 768px) {
  .logincss{
    margin-right: 50px !important;
  }
}
@media only screen and (min-width: 768px) {
  /* .logincss{
    margin-right: 349px;
  } */
}
  .logincss{
    background:white;
  }
  </style>
   <div class="col-md-6 col-xs-12 offset-md-2 col-sm-12" style="font-size: 24px;font-family:initial; color:#6a6a79;">
   <strong>NASH HR MANAGEMENT SYSTEM </strong>
  </div>
  <div class="row " style="">
        <div class="col-md-3 col-xs-12 offset-md-2 col-sm-12" style="margin-top:40px">
       
     <form method="POST" action="{{ route('login') }}" class="login-form" id="form">
         @csrf
        <div class="row">
          <!-- <div class="input-field col s12 center">
            <p class="center login-form-text" style="font-size:14px;">HR Management System</p>
          </div> -->
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-social-person-outline prefix"></i>
            <input id="email" type="text" placeholder="{{ __('User Name') }}" class="{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus>
            <label for="username" class="center-align " @if($errors->has('email')) data-error={{ $errors->first('email') }} @endif >User Name</label>
		  @if($errors->has('email'))
					<span class="invalid-feedback  form-control-feedback" role="alert">
						<strong>{{ $errors->first('email') }}</strong>
					</span>
               @endif
          </div>
        </div>
        <div class="row margin">
          <div class="input-field col s12">
            <i class="mdi-action-lock-outline prefix"></i>
           <input id="password" ng-message="required"  type="password" class="error-msg {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
            <label for="password">Password</label>
              @if ($errors->has('password'))
					<span class="invalid-feedback form-control-feedback" role="alert">
						<strong>{{ $errors->first('password') }}</strong>
					</span>
				@endif
          </div>
        </div>
         
        <div class="row">
            
            <button type="submit" style="background-color:#295174;" class="btn col s12">{{ __('Login') }}</button>
            
			<!--<a href="javascript:void(0);" onclick="document.getElementById('form').submit();" class="btn waves-effect waves-light col s12">Login</a>-->
          </div>

        
   


      </form>
    </div>
  </div>

    

<!-- /.login-box -->
@endsection

@push('scripts')
	<script src="{{ asset('plugins/icheck/icheck.min.js' ) }}"></script>
	<script>

	  // $(document).ready(function(){
		//   $('input').iCheck({
		// 	checkboxClass: 'icheckbox_square-blue',
		// 	radioClass: 'iradio_square-blue',
		// 	increaseArea: '20%' // optional
		//   });
		// });
	</script>

  <script type="text/javascript" src="{{ asset('js/js/plugins/jquery-1.11.2.min.js') }}"></script>

  <script type="text/javascript" src="{{ asset('js/js/materialize.min.js') }}"></script>
  <!--scrollbar-->
  <script type="text/javascript" src="{{ asset('js/js/plugins/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>

      <!--plugins.js - Some Specific JS codes for Plugin Settings-->
    <script type="text/javascript" src="{{ asset('js/js/plugins.min.js') }}"></script>
    <!--custom-script.js - Add your own theme custom JS-->
    <script type="text/javascript" src="{{ asset('js/js/custom-script.js') }}"></script>

	  <script src="{{ asset('js/vanta_master/vendor/three.r92.min.js') }}"></script>
	  
<script>
// VANTA.WAVES({
//   el: "#bodypage", 
// })
    
</script>    

@endpush

