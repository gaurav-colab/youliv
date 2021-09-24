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
                       
                          <i class="fa fa-plus"></i> Edit Sector
                     						
                    </div>
                    <div id="collapseOne" >
                        <div class="card-body">
                            <form class="form-horizontal" id="ownerForm" enctype="multipart/form-data" method="POST" action="{{url('/admin/')}}/sector/{{$id ?? ''}}/edit">
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
										<label for="phone" class="label">City Name</label>:{{$city_name}} 
									</div>
								</div>
                                <div class="form-group row">
									<div class="col-md-6">
										<label for="name" class="label">Name</label>
										<span class="required">*</span>
										<input class="form-control" id="name" type="text" name="name" placeholder="Enter name" value="{{old('name',$sector->name ?? '')}}">

										@error('name')
										<div class="error">{{ $message }}</div>
										@enderror

									</div>

								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="slug" class="label">Slug</label>
										<span class="required">*</span>
										<input class="form-control" id="slug" type="text" name="slug" placeholder="Enter slug" value="{{old('slug',$sector->slug ?? '')}}">

										@error('slug')
										<div class="error">{{ $message }}</div>
										@enderror

									</div>

								</div>
							
							<div class="col-md-3 mt-3">
									<button id="submit-owner-all" class="btn btn-primary-custom">Submit</button>
								</div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <input type="hidden" name="ownerId" id="ownerId" value="">                  
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
		'name':{
		  required : true,
		},
		'slug':{
		  required : true,
		}
	  }
	});
});
</script>


@endsection


