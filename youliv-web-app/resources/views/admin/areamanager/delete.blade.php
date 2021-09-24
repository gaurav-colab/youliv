@extends('admin.dashboard.base')

@section('content')


<meta name="csrf-token" content="{{ csrf_token() }}">

<div class="container-fluid">
    <div class="fade-in">
        <div class="bs-example">
            <div class="accordion" id="accordionExample">
            <!-- /Start General Owner Details-->
                <div class="card">
                    <div class="card-header" id="headingOne">
                       
                          <i class="fa fa-plus"></i> Assign/Delete Area Manager
                     						
                    </div>
                    <div id="collapseOne" >
                        <div class="card-body">
                            <form class="form-horizontal" id="ownerForm" enctype="multipart/form-data" method="POST">
                                @csrf
								<div class="col-md-12">
								@if (session('success'))
										  <div class="alert alert-success">
											{{ session('success') }}
										  </div>
										@endif
										@if (session('error'))
										  <div class="alert alert-warning">
											{{ session('error') }}
										  </div>
										@endif
								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="email" class="label">Current Area Manager: </label>										
										{{$areamanager_detail->name}}({{$areamanager_detail->phone}})

									</div>			
								</div>
												
                                <div class="form-group row">

                                    <div class="col-md-6">
                                        <label for="name" class="label">Assign Properties to Area Manager:</label>                                        
                                       <select class="form-control" id="area_manager_id" name="area_manager_id" >
											<option selected="true" disabled="disabled">Select area manager</option>
												@foreach ($area_managers as $manager)
												<option value="{{$manager['id']}}" style="display:@if($manager['id']==$areamanager_detail->id) {{'none'}}  @endif ">{{$manager['name']}}</option>
												@endforeach
                                        </select>

                                        @error('name')
                                            <div class="error">{{ $message }}</div>
                                        @enderror

                                    </div>
							</div>
							
							<div class="col-md-3 mt-3">
									<input type="hidden" name="areamanager_id" id="areamanager_id" value="{{$areamanager_detail->id}}">      
									<button id="submit-owner-all" class="btn btn-primary-custom">Assign</button>
								</div>
                                </div>
                            </form>
                        </div>
                    </div>

                                
                    </div>
                </div>
            </div>
        </div>


@endsection

@section('javascript')

<script>
$(document).ready(function(){
	$('#ownerForm').validate({
	  errorElement: 'label',

	  errorPlacement: function(error,elem){
		var errorElemId=$(error).attr('id');
		if($("[id='"+errorElemId+"']").length){
		  $("[id='"+errorElemId+"']").replaceWith(error);
		}else{
			error.insertAfter(elem);
		}
	  },

	  rules: {
		'area_manager_id':{
		  required : true,
		}
	  }
	});
});
</script>


@endsection


