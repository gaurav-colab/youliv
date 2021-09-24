@extends('admin.dashboard.base')

@section('content')
<script src="{{ asset('public/admin/assets/js/delete.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i>Normal User List
                       
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
                                <th>Contact Number</th>
                                <th>Email</th>
								<th>Status</th>
								<th>Mobile Verified</th>
								<th>Schedule</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                      <tbody>
					   @if($user)
						@foreach($user as $value)
						<tr>
						 <td>{{ucfirst($value->name)}}</td>
						  <td>{{$value->mobilenumber}}</td>
						  <td>{{$value->email}}</td>
						  <td>@if($value->is_active==1) Active @else Inactive @endif</td>
						  <td>@if($value->is_mobile_verified==1) Yes @else No @endif</td>
						  <td><a href="{{url('/admin/property_schedule_list/')}}/{{$value->id}}">Schedule</a></td>
						  <td>
						  <span class="bank-edit ml-3">
						  	
							<a href="{{url('/admin')}}/user_detail/{{$value->id}}" class="view_link"><i class="fa fa-eye" title="View"></i></a>
							
							</span>
							<span class="bank-edit ml-3">
							<span title="Edit" data-action="edit" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="user">
							<i class="fa fa-pencil-alt edit_link" title="Edit"></i>
							</span>
							</span>
							<span class="bank-delete ml-3">
							<span title="Delete" data-action="delete" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="user">
							<i class="far fa-trash-alt del_link" title="Delete"></i>
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
      "orderable": false,
      "searchable": false,
      "targets": 3
    }
  ],"lengthMenu": [[ 50,100,150 -1], [50, 100, 150, "All"]],
  });
});
</script>
<script>
    function publish(id,status) {
        URL = "property_status/"+id+"/"+status;
        getUrl = "{{url('')}}/admin/"+URL;

        Swal.fire({
            title: 'Are you sure?',
            text: "You wan't to Unpublish this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, Unpublish it!'
        }).then((result) => {
            if (result.value) {

                window.location.href = getUrl;

            }
        })
    };

    function unPublish(id,status) {
        URL = "property_status/"+id+"/"+status;
        getUrl = "{{url('')}}/admin/"+URL;
        Swal.fire({
            title: 'Are you sure?',
            text: "You wan't to publish this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, publish it!'
        }).then((result) => {
            if (result.value) {
                window.location.href = getUrl;
            }
        })
    };





</script>



@endsection
