@extends('admin.dashboard.base')

@section('content')

<script src="{{ asset($server_path.'admin/assets/js/delete_property_request.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Property Add Request                       
                    </div>
                    <div class="card-body">
					<div class="show_msg_request alert" > </div>
                    <table class="table table-bordered data-table property-list-data" id="bank_table">
                        <thead>
                            <tr> 
                                <th>Owner name</th>
								<th>Owner Phone Number</th>  
								<th>Property Type</th>
								<th>Available For</th>								
								<th>City</th>
								<th>Admin Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
						@if($properties)
							@foreach($properties as $key=>$value)
							<tr>							
							 <td>{{$value['owner_name']}}</td>
							 <td><a href="{{url('/admin')}}/owner_detail/{{$value['owner_id']}}"> {{$value['owner_number']}} </a> </td>
							 <td>{{$value['property_type']}}</td>
							 <td>{{$value['gender']}}</td>
							 <td>{{$value['city']}}</td>
							 <td>
								<select id="status_{{$value['id']}}" name="status_{{$value['id']}}">
									<option value="0" @if($value['status']==0) selected=selected @endif>Pending</option> 
									<option value="1" @if($value['status']==1) selected=selected @endif>In Progress</option> 
									<option value="2" @if($value['status']==2) selected=selected @endif>Done</option> 
								</select>
								<button id="submit" name="submit" class="changestatus" data-value="{{$value['id']}}" >Change</button>
							</td>
							 <td width="150px">									
								 <span class="bank-edit ml-3">								
								<a href="{{url('/admin')}}/property_request_detail/{{$value['id']}}" class="view_link"><i class="fa fa-eye" title="View"></i></a>								
								</span>
								<span class="bank-edit ml-3">	
								<span title="Delete" data-action="delete" data-id="{{$value['id']}}" data-url="{{url('/admin')}}" data-type="property_lead_delete">
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
$(document).on('click', '.changestatus', function() {	
	id=$(this).data('value');	
	var select=$("#status_"+id).val();
	$.ajax({
       type: "POST",
       data:{"_token": "{{ csrf_token() }}","id":id,"status":select},
       url: $(location).attr('origin') + '/admin/change_property_admin_status',

       success: function(msg){
        $(".show_msg_request").show();	
		$('.show_msg_request').removeClass("alert_danger");	
		$('.show_msg_request').removeClass("alert_success");	
         if(msg.code == 200){         
				$(".show_msg_request").html('Status changed successfully');
				$(".show_msg_request").addClass("alert-success");
  		   }

         else { 
			$(".show_msg_request").html('Something went wrong');
			$(".show_msg_request").addClass("alert_danger");
			$('.show_msg_request').removeClass("alert_success");	
				//window.location.href = $(location).attr('origin') + '/propertylist_detail/'+msg.id;			
				
         }
       }
    });
});    

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
