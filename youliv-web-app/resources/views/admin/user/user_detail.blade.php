@extends('admin.dashboard.base')
@section('content')
<div class="container-fluid">
	<div class="fade-in">
	

		<!-- /Start General Owner Details-->
			<div class="row">
		<div class="col-md-12">
		<div class="card">
			<div class="card-header">
			<strong>User Detail: {{ ucfirst($user->name) }}</strong>
			</div>
			<div class="card-body general-card">
			<div class=" row">
				
				<div class="col-md-5">
				<h6 style="margin-bottom:12px"><strong>Name:</strong> {{ ucfirst($user->name) }}</h6>
					<h6><strong>Email Address:</strong>
				{{ $user->email}}</h6>
				  <h6><strong>Occupantion</strong>
                                    @if($user->occupantion == 1) {{_('Student')}}
                                        @elseif($user->occupantion == 2) {{_('Govt Employee')}}
                                        @elseif($user->occupantion == 3) {{_('Private Job')}}
										@elseif($user->occupantion == 4) {{_('Traveller')}}										 
                                        @endif
                                    
                                </h6>
								<h6><strong>Gender</strong>
				@if($user->gender==1) Male @else Female @endif</h6>
				</div>
				<div class="col-md-4">
				<h6 style="margin-bottom:12px"><strong>Contact Number:</strong>
				{{ $user->mobilenumber}}</h6>
				<h6><strong>Status</strong>
				@if($user->is_active==1) Active @else Inactive @endif</h6>
				<h6><strong>Mobile Verified</strong>
				@if($user->is_mobile_verified==1) Yes @else No @endif</h6>
				</div>
                </div>



               

				<!-------------- if Proprty leased ends ----------------------->

				<!-------------- If Id Proofs----------------------->
				<div class="row propert-identity-term">					
					<div class="card-body">
						<div class="row">
							<div class="col-md-6">
						<div class="adhar-div">
						    
							<div class="proof-front" data-toggle="modal" data-target="#proof-front-modal">
							    <img src="{{url('')}}/public/profileimage/{{ $user->image }}" alt="Profile Pic">
							</div>
						</div>
                      
								</div>
							</div>

					</div>
				</div>
				<!-------------- Id Proofs ends----------------------->


			</div>
			</div>
		</div>
		</div>
		<!-- /Start General Owner Details ends-->

	</div>
</div>

<!--address modal-->
<div class="modal fade" id="proof-front-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       	<img src="{{ url('') }}/public/profileimage/{{ $user->image }}" alt="Profile Pic" width="70%">
      </div>
    </div>
  </div>
</div>



@endsection
