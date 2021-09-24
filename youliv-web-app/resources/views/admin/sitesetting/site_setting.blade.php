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
                         <i class="fa fa-align-justify"></i> Site Setting
                    </div>
					
                    <div >
                        <div class="card-body">
                            <form class="form-horizontal" id="site_setting" enctype="multipart/form-data" method="POST" action="{{url('admin/site_setting/'.$sitesetting->id)}}">
                                @csrf
								
                                <div class="form-group row">
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
                                    <div class="col-md-12">
                                        <label for="title" class="label">Site Title</label>
                                        <span class="required">*</span>
                                        <input class="form-control" style="background:#fff;color:#495057;font-weight:normal;font-size:15px;" id="title" type="text" name="title" placeholder="Site Title" value="{{old('title',$sitesetting->title ?? '')}}">

                                        @error('title')
                                            <div class="alert alert-danger">{{ $message }}</div>
                                        @enderror

                                    </div>

                                        <div class="col-md-12">
                                            <label for="meta_description" class="label">Meta Description</label>
                                            <span class="required">*</span>
											<textarea name="meta_description" id="meta_description" cols="30" rows="10" class="form-control full">{{old('meta_description',$sitesetting->meta_description ?? '')}}</textarea>
                                            @error('meta_description')
                                                <div class="alert alert-danger">{{ $message }}</div>
                                            @enderror

                                        </div>
                                        <div class="col-md-3 mt-3">
                                            <button id="submit-owner-all" class="btn btn-primary-custom">Submit</button>
                                        </div>

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
	$('#site_setting').validate({
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
		'title':{
		  required : true,
		},
		'meta_description':{
		  required : true,
		}
	  }
	});
});
</script>

@endsection


