@extends('admin.dashboard.base')

@section('content')

<script src="{{ asset($server_path.'admin/assets/js/delete_property.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Property List
                        <div class="col-6 col-sm-4 col-md-3  mb-3 mb-xl-0" style="float:right;">
                            <button class="btn btn-block btn-primary-custom" type="button"><a style="color:#fff" href="add_property">Add New Property</a></button> <button class="btn btn-block btn-primary-custom" type="button"><a style="color:#fff" href="bulk_upload_property">Bulk Upload</a></button>
                        </div>
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered data-table property-list-data" id="bank_table">
                        <thead>
                            <tr>                               
                                <th>Property Code</th>
                                <th>Owner name</th>
								<th>Owner Phone Number</th>                              
                                <th>Area manager</th>
								<th>Area Phone Number</th>
								<th>Property Type</th>
								<th>Available For</th>
								<th>Verified</th>
								<th>City</th>
								<th>Featured Property</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						@if($properties)
							@foreach($properties as $key=>$value)
							<tr>
							 <td>{{$value['property_code']}}</td>
							  <td>{{$value['owner_name']}}</td>
							  <td>@if($value['owner_id']!="") <a href="{{url('/admin')}}/owner_detail/{{$value['owner_id']}}"> {{$value['owner_number']}} </a> @else  {{$value['owner_number']}} @endif </td>
							 <td>{{$value['area_manager']}}</td>
							 <td>@if($value['area_manager_id']!="") <a href="{{url('/admin')}}/area_manager_detail/{{$value['area_manager_id']}}">{{$value['area_manager_phone']}} </a> @else  {{$value['area_manager_phone']}} @endif</td>
							 <td>{{$value['property_type']}}</td>
							 <td>{{$value['gender']}}</td>
							 <td>{{$value['verified']}}</td>
							 <td>{{$value['city']}}</td>
							 <td>{{$value['featured']}}</td>
							 <td width="150px">
							  <span class="bank-edit ml-3">	
								@if($value['status']=='1') <?php $class="green_link"?> @else <?php $class="edit_link"?>  @endif							  
								<span title="Publish/Unpublish" @if($value['status']=='1') data-action="Unpublish"  @else data-action="Publish"  @endif data-id="{{$value['id']}}" data-url="{{url('/admin')}}" data-type="property_status">
								<i class="fa fa-circle {{$class}}" title="Publish/Unpublish"></i>
								</span>
								 <span class="bank-edit ml-3">								
								<a href="{{url('/admin')}}/property_detail/{{$value['id']}}" class="view_link"><i class="fa fa-eye" title="View"></i></a>								
								</span><br>
								<span class="bank-edit ml-3">
								<span title="Edit" data-action="edit" data-id="{{$value['id']}}" data-url="{{url('/admin')}}" data-type="property_detail">
								<i class="fa fa-pencil-alt edit_link" title="Edit"></i>
								</span>
								<span class="bank-delete ml-3">
								</span>
								<span title="Delete" data-action="delete" data-id="{{$value['id']}}" data-url="{{url('/admin')}}" data-type="property_detail">
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
      "targets": 3
    }
  ],"lengthMenu": [[ 50,100,150 -1], [50, 100, 150, "All"]],
  });
});


</script>



@endsection
