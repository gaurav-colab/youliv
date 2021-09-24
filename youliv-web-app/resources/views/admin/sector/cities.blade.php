@extends('admin.dashboard.base')

@section('content')
<script src="{{ asset('public/admin/assets/js/delete.js')}}"></script>
<div class="container-fluid">
            <div class="fade-in">
              <div class="row">
                <div class="col-lg-12">
                  <div class="card">
                    <div class="card-header"><i class="fa fa-align-justify"></i> Cities
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
					</div>
                    <div class="card-body">
                    <table class="table table-bordered data-table property-list-data" id="bank_table">
                        <thead>
                            <tr>                                
                                <th>Name</th>
                                <th>View Sectors</th>   
                            </tr>
                        </thead>
                      <tbody>
					   @if($cities)
						@foreach($cities as $value)
						<tr>
						 <td>{{$value->name}}</td>						 
						 <td><a href="{{url('/admin/sector_list/')}}/{{$value->id}}">View</a></td>
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
      "targets": 1
    }
  ]
  });
});
</script>

@endsection
