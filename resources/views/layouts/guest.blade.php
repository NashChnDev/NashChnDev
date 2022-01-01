<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>{{ config('app.name') }} | @yield('page-title') </title>
		
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
        
     <!--   <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">-->
        
        <link href="{{ asset('css/css/animate.css') }}" rel="stylesheet">
        
         <link rel="stylesheet" href="{{ asset('assets/select2/dist/css/select2.min.css') }}">
        
        <!--checkbox color-->
        
        <link href="{{ asset('css/css/style2.css') }}" rel="stylesheet">
        
		<!--<link href="{{ asset('css/fileinput.css') }}" media="all" rel="stylesheet">-->
		
    <!--<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet">-->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
        
<!--datepicker css-->      
<link rel="stylesheet" href="{{ asset('css/css/jquery-ui.css') }}">

<link href="{{ asset('css/css/style.min.css') }}" type="text/css" rel="stylesheet">
        
<link href="{{ asset('css/css/jquery-clockpicker.min.css') }}" type="text/css" rel="stylesheet">

        
		<!-- Google Font: Source Sans Pro -->
                <link href="{{ asset('css/font/font_family/font_family.css?family=Source+Sans+Pro:300,400,400i,700') }}" rel="stylesheet">
		<!--<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">-->
        
        <script type="text/javascript" src="{{ asset('js/js/angular.min.js') }}"></script>

            <style type="text/css">
        .main-section{
            margin:0 auto;
            padding: 10px;
            margin-top: 20px;
            margin-bottom: 20px;
            background-color: #fff;
            box-shadow: 0px 0px 20px #c1c1c1;
        }
        .fileinput-remove,
        .fileinput-upload{
            display: none;
        }
                
  .onerow{
    display:inline-block;
      
      
}
    .select2-container--default .select2-selection--multiple .select2-selection__choice {
    background-color: #3c8dbc;
    border-color: #367fa9;
    padding: 1px 10px;
    color: #fff;
}
</style>

   
        
@stack('css')
	</head>
	<body class="hold-transition sidebar-mini  sidebar-open">
		<div class="wrapper" id="app" ng-app="myApp" >
            
    <!--<div id="loader-wrapper">
      <div id="loader"></div>        
      <div class="loader-section section-left"></div>
      <div class="loader-section section-right"></div>
  </div>-->
  
@yield('content')

@include('layouts.footer')

		</div>
	<!-- REQUIRED SCRIPTS 
        
             <!--plugins.js - Some Specific JS codes for Plugin Settings-->
  <!--  <script type="text/javascript" src="{{ asset('js/js/plugins.min.js') }}"></script> -->
 
        
    <!--     <script src="{{ asset('js/bootstrap.min.js') }}"></script> -->
        
        
	<script src="{{ asset('js/app.js') }}" ></script>
        


	<!-- SlimScroll 1.3.0 -->

	<script src="{{ asset('js/jquery.slimscroll.min.js') }}"></script>
        
      
    <script type="text/javascript" src="{{ asset('js/js/jquery-clockpicker.min.js') }}"></script>
	
	<script src="{{ asset('js/theme.js') }}"></script>
	<script src="{{ asset('js/fileinput.js') }}"></script>
	<script src="{{ asset('js/popper.min.js') }}"></script>
 
	
    <script src="{{ asset('js/jquery.babypaunch.spinner.min.js') }}"></script>     

        <!--datepicker Js-->
        
    <script type="text/javascript" src="{{ asset('js/js/jquery-ui.js') }}"></script>
        
    <script type="text/javascript" src="{{ asset('js/js/moment.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/jquery.inputmask.bundle.js') }}"></script>
    <script type="text/javascript" src="{{ URL::asset('js/nash.js') }}"></script>
 
        
               <!--plugins.js - Some Specific JS codes for Plugin Settings-->
               

	
	<script type="text/javascript">
        
        var app=angular.module('myApp', []);
        
        
	$(function(){

		// sends the uploaded file file to the fielselect event
		$(document).on('change', ':file', function() {
			var input = $(this);
			var label = input.val().replace(/\\/g, '/').replace(/.*\//, '');

			input.trigger('fileselect', [label]);
		});

		// Set the label of the uploaded file
		$(':file').on('fileselect', function(event, label) {
			$(this).closest('.uploaded-file-group').find('.uploaded-file-name').val(label);
		});
		
		// Deals with the upload file in edit mode
		$('.custom-delete-file:checkbox').change(function(e){
			var self = $(this);
			var container = self.closest('.input-width-input');
			var display = container.find('.custom-delete-file-name');

			if (self.is(':checked')) {
				display.wrapInner('<del></del>');
			} else {
				var del = display.find('del').first();
				if (del.is('del')) {
					del.contents().unwrap();
				}
			}
		}).change();
	});
	</script>
	
	<script>
	  $(".sidebar").slimScroll({
		height: $(".sidebar").outerHeight(true),
         // color: '#ff4800', 
         //  width: '500px',
	  });
	</script>
        
        
        <script type="text/javascript">
var CountryController = app.controller('CountryController',function($scope,$http)
{
    $scope.company_country='';
    $scope.company_state='';
    $scope.company_city='';
    $scope.States=[];
    $scope.Cities=[];
    $scope.getStateDetails=function()
    {
    $http.get('{{route("companies.company.index")}}'+'/getStateDetails/'+$scope.company_country).then(function(response){
			if(response.data.status=='success')
			{
				$scope.States=response.data.data;
			}
			else
			{
				$scope.States=response.data.msg;
			}
		});
    };
    
    $scope.getCityDetails=function()
    {
       // console.log($scope.company_state);
            $http.get('{{route("companies.company.index")}}'+'/getCityDetails/'+$scope.company_state.id).then(function(response){
			if(response.data.status=='success')
			{
				$scope.Cities=response.data.data;
			}
			else
			{
				$scope.Cities=response.data.msg;
			}
		});
    };
    
    @if(isset($companies))
    
    $scope.companies = @json($companies);
    $scope.company_name = '';
    $scope.company_id = '';
    $scope.display_company_name =function()
    {
        find_company=$scope.companies.find(company=>company.company_code==$scope.company_id)
        $scope.company_name=find_company.company_name;
    }
    
    @endif
        

       @stack('country-edit-script') 
    
       @stack('Employee_DeptInfo_scripts') 
    
     });
    
    

               
</script>
        
        
<script>

$(function(){
@if(Session::has('success_message'))
    $.notify({
      title: '<strong>Success </strong>',
      icon: 'glyphicon glyphicon-star',
      message: " {!! session('success_message') !!}"
    },{
      type: 'success',
      animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 5,
      z_index: 1031,
      delay: 3000,
	  timer: 1000,
    });
@endif
});
    
    
    $(function(){
@if($errors->any())
       @foreach ($errors->all() as $error) 
    $.notify({
      title: '<strong>Error </strong>',
      icon: 'glyphicon glyphicon-star',
      message:"{{ $error }}"
    },{
      type: 'danger',
      animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 5,
      z_index: 1031,
      delay: 9000,
	  timer: 1000,
    });
@endforeach
        '<br>'
@endif
});
      

</script>
        
	<script src="{{asset('assets/select2/dist/js/select2.full.min.js')}}"></script>
	<!-- PAGE SPECIFIC SCRIPTS -->
@stack('scripts')
        
        
        <!--FireBase Control  --- Start -->
        
        
<!--<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-app.js"></script>      
<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-auth.js"></script>
<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-database.js"></script>       

<script src="https://www.gstatic.com/firebasejs/7.8.0/firebase-analytics.js"></script>

<script type="text/javascript">
var session_id = "{!! (Session::getId())?Session::getId():'' !!}";
var user_id = "{!! (Auth::user())?Auth::user()->id:'' !!}";
var firebase;
// Initialize Firebase
var config = {
    apiKey: "AIzaSyBLACiDTrMs5fv_KRf2MMpDHPXF1kMorNU",
    authDomain: "multiloginsamecredential.firebaseapp.com",
    databaseURL: 'https://multiloginsamecredential.firebaseio.com', //'http://localhost/https://my.firebaseio.com', //"firebase.database_url",
    storageBucket: "multiloginsamecredential.appspot.com",
};
firebase.initializeApp(config);

var database = firebase.database();

if({!! Auth::user() !!}) {
    firebase.database().ref('/users/' + user_id + '/session_id').set(session_id);
}

firebase.database().ref('/users/' + user_id).on('value', function(snapshot2) {
    var v = snapshot2.val();

    if(v.session_id != session_id) {
        
        $.notify({
      title: '<strong>Error </strong>',
      icon: 'glyphicon glyphicon-star',
      message:"'Warning Alert' - Your account login from another device!!'"
    },{
      type: 'danger',
      animate: {
        enter: 'animated fadeInUp',
        exit: 'animated fadeOutRight'
      },
      placement: {
        from: "top",
        align: "right"
      },
      offset: 20,
      spacing: 5,
      z_index: 1031,
      delay: 9000,
	  timer: 1000,
    });
        
        setTimeout(function() {
           window.location = '/login';
        }, 4000);
        
       /* toastr.warning('Your account login from another device!!', 'Warning Alert', {timeOut: 3000});
        setTimeout(function() {
           window.location = '/login';
        }, 4000);*/
    } 
});
</script>-->
        
        
        <!--FireBase Control  --- Start -->
        
        
	</body>
    

    <script type="text/javascript" src="{{ asset('js/js/jquery-migrate-1.4.1.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/js/plugins.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('js/bootstrap-notify.min.js') }}"></script>
    
  
 
</html>
					