@extends('layouts.app')
@section('page-title','Configurations List')
@section('content')
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Configurations</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
			  <li class="breadcrumb-item active">Configurations List</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
	<!--@if(Session::has('success_message'))
        <div class="alert alert-success">
            <span class="fa fa-ok"></span>
            {!! session('success_message') !!}
            <button type="button" class="close" data-dismiss="alert" aria-label="close">
                <span aria-hidden="true">&times;</span>
            </button>
       </div>
    @endif-->
    <!-- Main content -->
	
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
			<div class="col-12">
				<div class="card card-primary card-outline">
				   <div class="card-header">
						<h3 class="card-title clearfix">Configurations</h3>
						<div class="card-tools">
						   <a href="{{ route('configurations.configurations.create') }}" class="btn btn-sm pl-3 pr-3 bg-success float-right clearfix" title="Create New Configurations"  role="button">
								<span class="fa fa-plus" aria-hidden="true"> Add</span>
							</a>
						</div>
					</div>
					
						<div class="card-body table-responsive">
							<table class="table table-sm table-hover" style="width:100%" >
								<thead>
									<tr>
												<th>Key</th>
		<th>Reqprefix</th>
		<th>Reqsuffix</th>
		<th>Is Active</th>

										<th>Action</th>
									</tr>
								</thead>
                 <tbody>
                    @foreach($configs as $config)
                        <tr>
                          <!--<form ng-controller="AutosaveController" method="POST" action="{{ route('configurations.configurations.update', $config->id) }}" name="edit_config_form" > -->
                            
                           <td>
                            <label>{{ old('key', optional($config)->key) }}</label>
                            <input type="hidden" value="{{$config->key}}" id="keyvalue" name="keyvalue" >
                           
                           </td>
<td>
    <input class="form-control" name="reqprefix" type="text" id="reqprefix" value="{{ old('reqprefix', optional($config)->reqprefix) }}" minlength="1" placeholder="Enter reqprefix here..." readonly="readonly">
</td>     
<td>
    <input class="form-control" name="reqsuffix" type="text" id="reqsuffix" value="{{ old('reqsuffix', optional($config)->reqsuffix) }}" minlength="1" placeholder="Enter reqsuffix here..." readonly="readonly">
</td>
<td>
    <input id="is_active_1" class="" name="is_active" type="checkbox" value="1" {{ old('is_active', optional($config)->is_active) == '1' ? 'checked' : '' }}>
</td>

                    <td>                             
                        <div class="btn-group btn-group-xs pull-right" role="group">  
                           <input name="_method" type="hidden" value="PUT">  
                                 {{ csrf_field() }}
                                <div class="savebutton" >  
                             <button type="button"  class="btn btn-sm btn-success savebutton"  onclick="sumbitform(this)" title="Save Company">
                              <span class="fa fa-save" aria-hidden="true"></span>
                             </button>
                          </div>
                             <a href="" id="edit" class="btn btn-sm btn-primary editname" title="Edit Config">
                               <span class="fas fa-pencil-alt" aria-hidden="true"></span>
                             </a>        
                        </div>                       
                            </td>
          
                        <!--</form>-->
                        </tr>
                    @endforeach
                </tbody>
							</table>
						</div><!--/. card-body -->
				</div><!--/. card -->
			</div>
		</div> <!--/. row -->
	  </div><!--/. container-fluid -->
    </section>
	<!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
@endsection


@push('scripts')

<script type="text/javascript">
  $('.editname').click(function(){

    var $tr = $(this).closest('tr')        
    $tr.find('input').removeAttr('readonly');
      $('.savebutton').show();
      
    
});
function sumbitform(that){
    console.log("In");
      row=$(that).closest("tr");
      keyvalue=(row.find('#keyvalue').val());
      reqprefix=(row.find('#reqprefix').val());
      reqsuffix=(row.find('#reqsuffix').val());
    
    
    
    $.ajax({
        headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') },
        type: "POST",
        url: "{{route('configurations.configurations.index')}}"+'/autosave/'+keyvalue,
		data: "reqprefix=" + reqprefix + "&reqsuffix=" + reqsuffix,
		success: function(data) {
            console.log(data.status);
            if(data.status == 0)
                {
                    alert(data.msg);
                    location.reload(true)
                }
            else
                {
                   alert(data.msg);
                    location.reload(true)
                }
			//alert('Status Changed');
			
		}
 });
        
   
  }
    
        $(function() {
            $('.savebutton').hide();
        
        });

   
</script>
@endpush




