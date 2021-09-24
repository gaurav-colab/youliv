@extends('property_owner.dashboard.base')

@section('content')


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Property List 
                        
                    </div>
                    <div class="card-body">
                    <table class="table table-bordered data-table property-list-data">
                      <thead>
                        <tr>
                          <th>Property Code</th>
                          <th>Property Type</th>
                          <th>Availble For</th>
                          <th>Owner name</th>
                          <th>Address</th>
                          <th>Area manager</th>
                         
                        </tr>
                      </thead>
                      <tbody>
					  @if($properties)
						  
							@foreach($properties as $key=>$value)
							<tr>
						
								<td><a href="{{url('/property_owner/property_detail/')}}/{{$value['id']}}">{{$value['property_code']}}</a></td>
								<td>{{$value['property_type']}}</td>
								<td>{{$value['gender']}}</td>
								<td>{{$value['owner_name']}}({{$value['owner_number']}})</td>
								<td>{{$value['property']['property_addresses']['address_house']}}, {{$value['property']['property_addresses']['address_building']}}, {{$value['property']['property_addresses']['address_street']}}, {{$value['sector']}}, {{$value['city']}}, {{$value['state']}}</td>
								<td>{{$value['area_manager']}}({{$value['area_manager_phone']}})</td>
								
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



@endsection