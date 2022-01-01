@extends('layouts.app')

@section('page-title','Change password')

@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Change password</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
              <li class="breadcrumb-item active">Change password</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
      
        <section class="content">
      <div class="container-fluid">
   
        <div class="row">
                    <div class="col-12">
				<div class="card card-primary card-outline">
                <div class="card-header">
                    <h4 class="card-title">Change password</h4>
                    
                </div>
                        
                        
                        <div class="content">
                            



        {!! Form::open(['method' => 'PATCH', 'route' => ['auth.change_password']]) !!}
	
        <!-- If no success message in flash session show change password form  -->
        
				
			

            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        {!! Form::label('current_password', 'Current password*', ['class' => 'col-sm-4 control-label']) !!}
                        {!! Form::password('current_password', ['class' => 'form-control', 'placeholder' => '','style'=>'width: 50%']) !!}
                        <p class="help-block"></p>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        {!! Form::label('new_password', 'New password*', ['class' => 'col-sm-4 control-label']) !!}
                        {!! Form::password('new_password', ['class' => 'form-control ', 'placeholder' => '','style'=>'width: 50%']) !!}
                        <p class="help-block"></p>
                        
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12 form-group">
                        {!! Form::label('new_password_confirmation', 'New password confirmation*', ['class' => 'col-sm-4 control-labell']) !!}
                        {!! Form::password('new_password_confirmation', ['class' => 'form-control', 'placeholder' => '','style'=>'width: 50%']) !!}
                        <p class="help-block"></p>
                        
                    </div>
                </div>
           
               
                
                <center>
        
        

        {!! Form::submit(trans('Save'), ['class' => 'btn btn-danger']) !!}
        {!! Form::close() !!}
                </center>
                 </div>
                        </div>
        </div>
</div>
</div>
            </div>
      </section>
</div>


    
@stop

