@extends('admin.dashboard.base')
@section('content')
<div class="container-fluid">
	<div class="fade-in">
	

		<!-- /Start General Owner Details-->
			<div class="row">
		<div class="col-md-12">
		<div class="card">
			<div class="card-header">
			<strong>General details(Owner)</strong>
			</div>
			<div class="card-body general-card">
			<div class=" row">
				
				<div class="col-md-5">
				<h6 style="margin-bottom:12px">Name: <strong>{{ $owner_detail->owner_name }}</strong></h6>
					<h6>Email Address:
				<strong>{{ $owner_detail->owner_email}}</strong></h6>
				</div>
				<div class="col-md-4">
				<h6 style="margin-bottom:12px">Contact Number:
				<strong>{{ $owner_detail->owner_number}}</strong></h6>
				<h6>Alternate Contact:
				<strong>{{ $owner_detail->alernate_number}}</strong></h6>
				</div>
                </div>



               

				<!-------------- if Proprty leased ends ----------------------->

				<!-------------- If Id Proofs----------------------->
				<div class="row propert-identity-term">
					<div class="col-md-12 card-header">
					    <strong>Identity Proof</strong>
					</div>
					<div class="card-body">
						<div class="row">
						    <div class="col-md-6">
						        <h6>Owner Id Proof: <strong>
                                    @if($owner_detail->property_owner_id_drop == 1 ){{_('Aadhar Card')}}
                                    @elseif($owner_detail->property_owner_id_drop == 2 ) {{_('Driving License')}}
                                    @elseif($owner_detail->property_owner_id_drop == 3 ) {{_('Passport')}}
                                    @elseif($owner_detail->property_owner_id_drop == 4 )  {{_('Voter Id')}}
                                    @endif
                                    </strong>
                                </h6>
							</div>
						    <div class="col-md-6">
                                <h6>GST Number: <strong>{{$owner_detail->property_gst}}</strong></h6>
						    </div>
						</div>

						<div class="row">
							<div class="col-md-6">
						<div class="adhar-div">
						    <h6><strong>Identity Proof</strong></h6>
							<div class="proof-front" data-toggle="modal" data-target="#proof-front-modal">
							    <img src="{{url('')}}/public/{{ $owner_detail->property_owner_id_front }}" alt="proof front">
							</div>
							<div class="proof-back" data-toggle="modal" data-target="#proof-back-modal">
							    <img src="{{url('')}}/public/{{ $owner_detail->property_owner_id_back }}" alt="proof back">
							</div>
						</div>
							
				

                        @if($owner_detail->id_proof_is_same_address == 2)
                            <div class="adhar-div different-proof">
                                <h6>Identity proof with different address:
                                    <strong>@if($owner_detail->property_diff_address == 1) {{_('Electricity Bill')}}
                                        @elseif($owner_detail->property_diff_address == 2) {{_('Registration Document')}}
                                        @elseif($owner_detail->property_diff_address == 3) {{_('Water bill')}}
                                        @endif
                                    </strong>
                                </h6>
                                <div class="diff-proof" data-toggle="modal" data-target="#diff-proof-modal">
                                <img src="{{ url('')}}/public/{{$owner_detail->property_address_img}}" alt="">
                                </div>
                            </div>
                        @endif
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


<!--*****************digital-sign*****************
		<div class="row">
			<div class="col-md-12">
			    <div class="card">
			        <div class="card-header">
				        <strong>Digital Signature</strong>
				    </div>
				    <div class="card-body digital-signatur ">
                        <figure data-toggle="modal" data-target="#digil-sign-Modal">
                            <img id="digital-sign" src="{{url('')}}/{{ $owner_detail->digital_signature }}" alt="digital Signature" width=300>
                        </figure>

				    </div>
			    </div>
			</div>
		</div>
<!--*****************digital-sign ends*****************-->

	</div>
</div>

<!--address modal-->
<div class="modal fade" id="addres-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
       	<img src="{{ url('') }}/public/{{$owner_detail->lease_deed}}" alt="address proof" width="70%">
      </div>
    </div>
  </div>
</div>

<!--proof-front-modal-->
<div class="modal fade" id="proof-front-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
      <img src="{{ url('')}}/public/{{ $owner_detail->property_owner_id_front }}" alt="proof front" width="70%">
      </div>
    </div>
  </div>
</div>


<!--proof-back-modal-->
<div class="modal fade" id="proof-back-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <img src="{{ url('')}}/public/{{ $owner_detail->property_owner_id_back }}" alt="proof back" width="70%">
      </div>
    </div>
  </div>
</div>



<!--diff-proof-modal-->
<div class="modal fade" id="digil-sign-Modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-body">
		   <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <img id="digital-sign" src="{{url('')}}/public/{{ $owner_detail->digital_signature }}" alt="digital Signature" width=300>
      </div>
    </div>
  </div>
</div>


@endsection
