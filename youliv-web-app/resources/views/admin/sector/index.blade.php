@extends('admin.dashboard.base')

@section('content')
<script src="{{ asset('public/admin/assets/js/delete.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Sectors of city {{$city_name}}
                         <div class="col-6 col-sm-4 col-md-3  mb-3 mb-xl-0" style="float:right;">
                            <button class="btn btn-block btn-primary-custom" type="button"><a style="color:#fff" href="{{url('/admin/')}}/sector/{{$id}}/add">Add Area Under Mohali</a></button>
                        </div>
                        </div>
                    </div>
					<div class="col-md-12" style="margin-top:20px;">
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
                    <div class="card-body">
                    <table class="table table-bordered data-table property-list-data" id="bank_table">
                        <thead>
                            <tr>                                
                                <th>Name</th>
								<th>Slug</th>
                                 <th width="150px">Action</th> 
                            </tr>
                        </thead>
                    
					   @if($sector)
						@foreach($sector as $value)
						<tr>
						 <td>{{$value->name}}</td>	
						 <td>{{$value->slug}}</td>	
						<td>					 
						 <span class="bank-edit ml-3">
							<a href="{{url('/admin/')}}/sector/{{$value->city_id}}/{{$value->id}}/edit" data-type="sector">
							<i class="fa fa-pencil-alt edit_link" title="Edit"></i>
							</a>
							</span>
							<span class="bank-delete ml-3">
							<span title="Delete" data-action="delete" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="sector">
							<i class="far fa-trash-alt del_link" title="Delete"></i>
							</span>
							</span>
							</td>
						</tr>
						@endforeach
					  @endif
                     
                    </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

@endsection

@section('javascript')


<script>
$(document).ready(function() {
 $('#bank_table').DataTable({
  "columnDefs" : [
    {
      "orderable": true,
      "searchable": true,
	  
      "targets": 2

    } 
  ],"lengthMenu": [[ 50,100,150 -1], [50, 100, 150, "All"]],
  });
});
</script>



@endsection
