@extends('admin.dashboard.base')

@section('content')
<script src="{{ asset($server_path.'admin/assets/js/delete.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Area Manager List
                        <div class="col-6 col-sm-4 col-md-3  mb-3 mb-xl-0" style="float:right;">
                            <button class="btn btn-block btn-primary-custom" type="button"><a style="color:#fff" href="add_area_manager">Add Area Manager</a></button>
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
                                <th>Phone number</th>
                                <th>Email</th>
								<th>View Property</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                      <tbody>
					   @if($owner_detail)
						@foreach($owner_detail as $value)
						<tr>
						 <td>{{$value->name}}</td>
						  <td>{{$value->phone}}</td>
						  <td>{{$value->email}}</td>
						 <td><a href="{{url('/admin/property_list/')}}?type=area_manager&id={{$value->id}}">View Property</a></td>
						  <td>
						  <span class="bank-edit ml-3">
						  	
							<a href="{{url('/admin')}}/area_manager_detail/{{$value->id}}" class="view_link"><i class="fa fa-eye" title="View"></i></a>
							
							</span>
							<span class="bank-edit ml-3">
							<span title="Edit" data-action="edit" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="area_manager">
							<i class="fa fa-pencil-alt edit_link" title="Edit"></i>
							</span>
							</span>
							<span class="bank-delete ml-3">
							<a href="{{url('/admin')}}/area_manager/{{$value->id}}/delete" class="del_link">
							
							<i class="far fa-trash-alt" title="Delete"></i>
							</span>
							</span>
						  </td>
						</tr>
						@endforeach
					  @endif
                      </tbody>
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
      "targets": 3
    }
  ],"lengthMenu": [[ 50,100,150 -1], [50, 100, 150, "All"]],
  });
});
</script>
<script>



</script>



@endsection
