
  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand bg-primary navbar-light elevation-2 fixed-top">
    <!-- Left navbar links -->
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#"><i class="fa fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="" target="_blank" class="nav-link">Nash Industries Pvt Ltd</a>
      </li>
      <!--<li class="nav-item d-none d-sm-inline-block">
        <a href="{{ url('customers')}}" class="nav-link">Contact</a>
      </li>-->
	  
    </ul>
	<ul class="navbar-nav ml-auto">
		<!-- SEARCH FORM -->
		<!--<form class="form-inline ml-3">
		  <div class="input-group input-group-sm">
			<input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
			<div class="input-group-append">
			  <button class="btn btn-navbar" type="submit">
				<i class="fa fa-search"></i>
			  </button>
			</div>
		  </div>
		</form>-->
	
	
	  	   @guest
			<li class="nav-item">
				<a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
			</li>
			<!--@if (Route::has('register'))
				<li class="nav-item">
					<a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
				</li>
			@endif-->
		@else
        

        

			<li class="nav-item dropdown">
				<a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
					{{ Auth::user()->name }} <span class="caret"></span>
				</a>

				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="{{ route('logout') }}"
					   onclick="event.preventDefault();
									 document.getElementById('logout-form').submit();">
                        <span style="color:blue">{{ __('Logout') }}</span>
					</a>

					<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
						@csrf
					</form>
				</div>
			</li>
		@endguest
	</ul>
  
  </nav>
  <!-- /.navbar -->
