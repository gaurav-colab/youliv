@extends('admin.dashboard.base')
@section('content')
<div class="container-fluid">
	<div class="fade-in">
	

		<!-- /Start General Owner Details-->
			<div class="row">
		<div class="col-md-12">
		<div class="card">
			<div class="card-header">
			<strong>Area Manager Detail</strong>
			</div>
			<div class="card-body general-card">
			<div class=" row">
				
				<div class="col-md-5">
				<h6 style="margin-bottom:12px"> <strong>Name:</strong>{{ $owner_detail->name }}</h6>
					<h6><strong>Email Address:</strong>
				{{ $owner_detail->email}}</h6>
				</div>
				<div class="col-md-4">
				<h6 style="margin-bottom:12px"><strong>Contact Number:</strong>
				{{ $owner_detail->phone}}</h6>
				<h6><strong>Employee Code:</strong>
				{{ $owner_detail->emp_code}}</h6>
				<h6><strong>Date of Joining:</strong>
				{{ $owner_detail->doj}}</h6>
				</div>
                </div>
				<div class=" row">
				<div class="col-md-5">
				<h6 style="margin-bottom:12px"><strong>Permanent Address: </strong><br>{{ $owner_detail->p_address }}</h6>
				
				</div>

				<div class="col-md-5">
				
					<h6><strong>Current Address: </strong><br>
				{{ $owner_detail->c_address}}</h6>
				</div>
               </div>

				<!-------------- if Proprty leased ends ----------------------->

				<!-------------- If Id Proofs----------------------->
				<div class="row propert-identity-term">
					<div class="col-md-12 card-header">
					    <strong>Pan Card</strong>
					</div>
					<div class="card-body">	
						<div class="row">
							<div class="col-md-6">
								<div class="adhar-div">								
								<div class="proof-front" data-toggle="modal" data-target="#pan-proof-front-modal">
									<img src="{{url('')}}/public/{{ $owner_detail->pan_front }}" alt="proof front">
								</div>
								<div class="proof-back" data-toggle="modal" data-target="#pan-proof-back-modal">
									<img src="{{url('')}}/public/{{ $owner_detail->pan_back }}" alt="proof back">
								</div>
								</div>
							</div>
						</div>

					</div>
				</div>
				<div class="row propert-identity-term">
					<div class="col-md-12 card-header">
					    <strong>Adhar Card</strong>
					</div>
					<div class="card-body">	
						<div class="row">
							<div class="col-md-6">
								<div class="adhar-div">								
								<div class="proof-front" data-toggle="modal" data-target="#adhar-proof-front-modal">
									<img src="{{url('')}}/public/{{ $owner_detail->adhar_front }}" alt="proof front">
								</div>
								<div class="proof-back" data-toggle="modal" data-target="#adhar-proof-back-modal">
									<img src="{{url('')}}/public/{{ $owner_detail->adhar_back }}" alt="proof back">
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
	</div>
</div>

<!--address modal-->
<div class="modal fade" id="pan-proof-front-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       	<img src="{{ url('') }}/public/{{$owner_detail->pan_front}}" alt="address proof" width="500px">
      </div>
    </div>
  </div>
</div>

<!--proof-front-modal-->
<div class="modal fade" id="pan-proof-back-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <img src="{{ url('')}}/public/{{ $owner_detail->pan_back }}" alt="proof front" width="500px">
      </div>
    </div>
  </div>
</div>


<!--proof-back-modal-->
<div class="modal fade" id="adhar-proof-front-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="{{ url('')}}/public/{{ $owner_detail->adhar_front}}" alt="proof back" width="500px">
      </div>
    </div>
  </div>
</div>



<!--diff-proof-modal-->
<div class="modal fade" id="adhar-proof-back-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <img src="{{ url('')}}/public/{{ $owner_detail->adhar_back}}" alt="proof back" width="500px">
      </div>
    </div>
  </div>
</div>


@endsection
