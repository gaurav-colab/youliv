@extends('property_owner.dashboard.base')

@section('content')

<style>
    .alert-danger {
        color: #772b35;
        background-color: #fff;
        border-color: #fff;
    }
    .alert{
        padding: 5px;
    }
</style>

<div class="container-fluid">
    <div class="fade-in">
        <div class="row">
            <div class="col-lg-12">
                <form class="form-horizontal" action="{{route('property_owner.submit_change_password')}}" method="post" enctype="multipart/form-data">
                {{ csrf_field() }}
                    <div class="card">
                        <div class="card-header">
                            <i class="fa fa-align-justify"></i>Change Password 
                        </div>
                        <div class="card-body">
                            @if ( Session::has('error') )
                                <div class="alert alert-danger">
                                    {{ Session::get('error') }}
                                </div>
                            @endif
                            @if ( Session::has('success') )
                                <div class="alert alert-danger">
                                    {{ Session::get('success') }}
                                </div>
                            @endif
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="old_password" class="label">Old Password</label>
                                    <span class="required">*</span>
                                    <input class="form-control" id="old_password" type="text" name="old_password" placeholder="Enter old password" value="{{old('old_password')}}">
                                    @error('old_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="new_password" class="label">New password</label>
                                    <span class="required">*</span>
                                    <input class="form-control" id="new_password" type="text" name="new_password" placeholder="Enter old password" value="{{old('new_password')}}">
                                    @error('new_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <label for="confirm_password" class="label">Confirm password</label>
                                    <span class="required">*</span>
                                    <input class="form-control" id="confirm_password" type="text" name="confirm_password" placeholder="Enter old password" value="{{old('confirm_password')}}">
                                    @error('confirm_password')
                                        <div class="alert alert-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="form-group row">
                                <div class="col-md-12">
                                    <input type="hidden" id="add_property_page">
                                    <button id="submit-all" class="btn btn-primary-custom" type="submit">Change password</button>
                                </div>

                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
