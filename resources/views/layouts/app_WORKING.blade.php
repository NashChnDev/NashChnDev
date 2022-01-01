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
		<!-- Google Font: Source Sans Pro -->
		<link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">

@stack('css')
	</head>
	<body class="hold-transition sidebar-mini">
		<div class="wrapper">

@include('layouts.navbar')

@include('layouts.sidebar')

@yield('content')

@include('layouts.footer')

		</div>
	<!-- REQUIRED SCRIPTS -->
	<script src="{{ asset('js/app.js') }}" ></script>
		<script type="text/javascript">
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
	<!-- PAGE SPECIFIC SCRIPTS -->
@stack('scripts')
	</body>
</html>
					