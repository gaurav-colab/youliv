@extends('admin.dashboard.base')

@section('content')
<script src="{{ asset($server_path.'/admin/assets/js/delete.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Owner Bank Detail Approval
                        <div class="col-6 col-sm-4 col-md-3  mb-3 mb-xl-0" style="float:right;">
                            
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
						@if(Session::has('message'))
						<p class="alert_owner alert {{ Session::get('alert-class', 'alert-info') }}">{{ Session::get('message') }}</p>
						@endif
					</div>
                    <div class="card-body">
                    <table class="table table-bordered data-table property-list-data" id="bank_table">
                        <thead>
                            <tr>                                
                                <th>Owner</th>
                                <th>Payment Type</th>
                                <th>Account Holder Name</th>
								<th>Mobile Number</th>
								<th>Status</th>
                                <th width="150px">Action</th>
                            </tr>
                        </thead>
                      <tbody>
					   @if($owner_detail)
						@foreach($owner_detail as $value)
						<tr>
						 <td>{{$value->owner->owner_name}}({{$value->owner->owner_number}})</td>
						<td>@if($value->payment_type==1) Bank Transfer @else UPI @endif</td>	
						  <td>{{$value->name}}</td>
						  <td>{{$value->mobile_number}}</td>
						  <td>@if($value->approved==0) Not Approved @else Approved @endif</td>						
						  <td>
						  <span class="bank-edit ml-3">
						  	
							<a href="{{url('/admin')}}/owner_bank_details/{{$value->id}}" class="view_link"><i class="fa fa-eye" title="View"></i></a>
							
							</span>
							<span class="bank-edit ml-3">
							<span title="Edit" data-action="edit" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="owner_bank_details">
							<i class="fa fa-pencil-alt edit_link" title="Edit"></i>
							</span>
							</span>
							<span class="bank-delete ml-3">
							<span title="Delete" data-action="delete" data-id="{{$value->id}}" data-url="{{url('/admin')}}" data-type="owner_bank_details">
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




@endsection
