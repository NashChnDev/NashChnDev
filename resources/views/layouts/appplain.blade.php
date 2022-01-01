
<!DOCTYPE html>
<html lang="en" >
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<!-- CSRF Token -->
		<meta name="csrf-token" content="{{ csrf_token() }}">
		<meta http-equiv="x-ua-compatible" content="ie=edge">

		<title>Nash HR Management | @yield('page-title')</title>
		<link href="{{ asset('css/app.css') }}" rel="stylesheet">
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
        
          <link href="{{ asset('css/css/materialize.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
          <link href="{{ asset('css/css/style.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
            <!-- Custome CSS-->    
            <link href="{{ asset('css/css/custom/custom.min.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
          <!-- <link href="{{ asset('css/css/layouts/page-center.css') }}" type="text/css" rel="stylesheet" media="screen,projection"> -->

          <!-- INCLUDED PLUGIN CSS ON THIS PAGE -->
          <link href="{{ asset('js/js/plugins/perfect-scrollbar/perfect-scrollbar.css') }}" type="text/css" rel="stylesheet" media="screen,projection">
          <link href='https://fonts.googleapis.com/css?family=Roboto' rel='stylesheet'>
        
    <style>

* {
  box-sizing: border-box;
}

body {
  margin: 0;
  /* font-family: Arial; */
  font-size: 17px;
}

#myVideo {
  position: fixed;
  right: 0;
  bottom: 0;
  min-width: 100%; 
  min-height: 100%;
}

.content {
  position: fixed;
  bottom: 0;
  background: rgba(0, 0, 0, 0.5);
  color: #f1f1f1;
  width: 100%;
  padding: 20px;
}

#myBtn {
  width: 200px;
  font-size: 18px;
  padding: 10px;
  border: none;
  background: #000;
  color: #fff;
  cursor: pointer;
}

#myBtn:hover {
  background: #ddd;
  color: black;
}       
</style>
        
@stack('css')
	</head>
   
	<body id="bodypage" class="DejaVue hold-transition  @yield('body-class')" style="background-color: #cccccc; background-image:url('img/21404.jpg'); background-repeat: no-repeat;background-size:cover;background-position: center;" ng-app="login" >
        
@yield('content')
	<!-- REQUIRED SCRIPTS -->
	<script src="{{ asset('js/app.js') }}" ></script>

@stack('scripts')
</body>
</html>


					