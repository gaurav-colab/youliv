@extends('admin.dashboard.base')

@section('content')
<script src="{{ asset('public/admin/assets/js/delete.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Property Schedule List
                       
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
                                <th>Property Code</th>
								<th>Property Title</th>
                                <th>Visit Time</th>
                                <th>User</th>
								<th>Status</th>
								<th>Approval</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                      <tbody>
					   @if($schedule)
						@foreach($schedule as $value)
						<tr>
						 <td>{{$value->property->property_code}}</td>
						 <td>{{$value->property_details->property_title}}</td>
						 <td>{{date('F d, Y' , strtotime($value->date))}} {{date('H:00 a', strtotime($value->visit_time))}}-{{date('H:00 a' ,strtotime($value->visit_time) + 60*60)}}</td>
						 <td>{{$value->user->name}}( {{$value->user->mobilenumber}})</td>
						 <td>@if($value->status==1) Visit Cancel @else Visit @endif</td>
						 <td>@if($value->approved==0) Not Approved @else Approved @endif</td>
						  <td>
							<span class="bank-edit ml-3">
							<span title="Edit" data-action="edit" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="schedule">
							<i class="fa fa-pencil-alt edit_link" title="Edit"></i>
							</span>
							</span>
							<span class="bank-delete ml-3">
							<span title="Delete" data-action="delete" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="schedule">
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
      "orderable": true,
      "searchable": true,
      "targets": 5
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
