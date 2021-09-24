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
                       
                          <i class="fa fa-plus"></i> Property Bulk Upload
                     						
                    </div>
                    <div id="collapseOne" >
                        <div class="card-body">
                            <form class="form-horizontal" id="ownerForm" method="POST" >
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
										<label for="spreadsheet_id" class="label">Spreadsheet Id</label>
										<span class="required">*</span>
										<input class="form-control" id="spreadsheet_id" type="text" name="spreadsheet_id" placeholder="Enter Spreadsheet Id" value="{{old('spreadsheet_id')}}">

										@error('spreadsheet_id')
										<div class="error">{{ $message }}</div>
										@enderror

									</div>

								</div>
								<div class="form-group row">
									<div class="col-md-6">
										<label for="sheet_id" class="label">Sheet Id</label>
										<span class="required">*</span>
										<input class="form-control" id="sheet_id" type="text" name="sheet_id" placeholder="Enter Sheet Id" value="{{old('sheet_id')}}">

										@error('sheet_id')
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
		'spreadsheet_id':{
		  required : true,
		},
		'sheet_id':{
		  required : true,
		}
	  }
	});
});
</script>


@endsection


