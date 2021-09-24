@extends('admin.dashboard.base')
@section('content')

<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Property Inventory 
                        
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered data-table property-list-data" id="bank_table">
                      <thead>
                        <tr>
                           <th>Room Type</th>   
						   <th>Description From </th>
						   <th>Description To </th>
						   <th>Quantity From </th>
						   <th>Quantity To </th>
						   <th>Rent From </th>
						   <th>Rent To </th>
						   <th>Security From </th>
						   <th>Security To </th>
						   <th>Request For </th>
                           <th>Request Status </th>           
                        </tr>
                      </thead>
                      <tbody>
					  @if($properties)
						  @php $owner_array=array(); @endphp
							@foreach($properties as $key=>$value)							
							<tr>	
								<td>
									@if($value->room_type==1)
										<?php $alt="Single Room";?>
									@elseif($value->room_type==2)
										<?php $alt="Twin Sharing Room";?>
									@elseif($value->room_type==3)
										<?php $alt="Triple Sharing Room"; ?>
									@elseif($value->room_type==4)
										<?php $alt="Other";?>
									@elseif($value->room_type==5)
										<?php $alt="1 RK"; ?>
									@elseif($value->room_type==6)
										<?php $alt="1 BHK"; ?>
									@elseif($value->room_type==7)
										<?php  $alt="2 BHK"; ?>	
									@elseif($value->room_type==8)
										<?php $alt="Other";?>	
									@elseif($value->room_type==9)
										<?php $alt="One Room"; ?>	
									@elseif($value->room_type==10)
										<?php $alt="Two Room"; ?>
									@elseif($value->room_type==13)
										<?php $alt="Three Room"; ?>	
									@elseif($value->room_type==14)
										<?php $alt="3 BHK"; ?>	
									@elseif($value->room_type==15)
										<?php $alt="4 BHK"; ?>											
									@else
										<?php $alt="Other Flat"; ?>															
									@endif
									<?php echo $alt;  ?>
								</td>	
								<td>{{$value->description_from}}</td>
								<td>{{$value->description_to}}</td>
								<td>{{$value->quantity_from}}</td>
								<td>{{$value->quantity_to}}</td>
								<td>{{$value->rent_from}}</td>
								<td>{{$value->rent_to}}</td>								
								<td>{{$value->security_from}}</td>
								<td>{{$value->security_to}}</td>
								<td>@if($value->status==2) Add @elseif($value->status==0) Edit @else Delete @endif </td>
								<td>
									<select id="request_status_{{$value->id}}" name="request_status_{{$value->id}}">
										<option value="0" @if($value->request_status==0) selected=selected @endif>Pending</option> 
										<option value="1" @if($value->request_status==1) selected=selected @endif>In Progress</option> 
										<option value="2" @if($value->request_status==2) selected=selected @endif>Done</option> 
									</select>
									<button id="submit" name="submit" class="changestatus" data-value="{{$value->id}}" >Change</button></td>						
							</tr>							
							@endforeach
							
					  @endif
                      </tbody>
                    </table>
					<div class="show_msg_request alert" > </div>
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
	console.log(id);
	var select=$("#request_status_"+id).val();
$.ajax({
       type: "POST",
       data:{"_token": "{{ csrf_token() }}","id":id,"request_status":select},
       url: $(location).attr('origin') + '/admin/change_inventory_status',

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
      "targets": 9
    }
  ],"lengthMenu": [[ 50,100,150 -1], [50, 100, 150, "All"]],
  });

</script>
@endsection

