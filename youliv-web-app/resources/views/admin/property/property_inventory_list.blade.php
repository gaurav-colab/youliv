@extends('admin.dashboard.base')
@section('content')

<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Property Inventory List 
                        
                    </div>
                    <div class="card-body">
					<div class="show_msg_request alert" > </div>
                    <table class="table table-bordered data-table property-list-data" id="bank_table">
                      <thead>
                        <tr>
                          <th>Property Code</th>
                          <th>Owner Name</th>
						   <th>Request Date</th>
						   <th>Admin Status</th>
                          <th>Action</th>
                         
                        </tr>
                      </thead>
                      <tbody>
					  @if($properties)
						  @php $owner_array=array(); @endphp
							@foreach($properties as $key=>$value)
							
							<?php if(!in_array($value->property->property_code,$owner_array)){ ?>
							<tr>						
								<td><a href="{{url('/admin/property_detail/')}}/{{$value->property->property_code}}">{{$value->property->property_code}}</a></td>
								<?php
									$owner=App\Owner::where('id',$value->property_owner->owner_id)->first();
									array_push($owner_array,$value->property->property_code);
								?>								
								<td>{{$owner->owner_name}}({{$owner->owner_number}})</td>
								<td>{{$value->created_at}}</td>
								<td>
									<select id="request_status_{{$value->id}}" name="request_status_{{$value->id}}">
										<option value="0" @if($value->request_status==0) selected=selected @endif>Pending</option> 
										<option value="1" @if($value->request_status==1) selected=selected @endif>In Progress</option> 
										<option value="2" @if($value->request_status==2) selected=selected @endif>Done</option> 
									</select>
									<button id="submit" name="submit" class="changestatus" data-value="{{$value->id}}" >Change</button></td>
								
								
								
								<td><a href="{{url('/admin/view_invent_request/')}}/{{$value->id}}">View Request</a></td>	
								
							</tr>
							<?php }?>
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
$(document).on('click', '.changestatus', function() {	
	id=$(this).data('value');	
	var select=$("#request_status_"+id).val();
	$.ajax({
       type: "POST",
       data:{"_token": "{{ csrf_token() }}","id":id,"request_status":select},
       url: $(location).attr('origin') + '/admin/change_inventory_admin_status',

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

 $('#bank_table').DataTable({
  "columnDefs" : [
    {
      "orderable": true,
      "searchable": true,
      "targets": 3
    }
  ],"lengthMenu": [[ 50,100,150 -1], [50, 100, 150, "All"]],
  });

</script>
@endsection
