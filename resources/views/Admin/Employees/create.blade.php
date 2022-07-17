@extends('layouts.admin')
@section('content')
<div id="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-start align-items-center mb-4">
            <h5 class="mb-0">Add Employee</h5>
        </div>
        <div class="row mt-3">
            <div class="col-md">
                <div class="card custom-card">
                    <div class="card-body">
                        <form action="{{ URL::to('employee') }}" class="custom-forms" method="POST">
                            @csrf
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">Company Name<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <select class="form-control custom-form" name="companyName">
                                        <option value="0">Please choose an option</option>
                                        @foreach($companies as $company)
                                        <option value="{{$company->id}}">{{$company->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                @if($errors->has('companyName'))
                                <div class="text-danger text-center">{{$errors->first('companyName')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">First Name<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control custom-form" name="first_name" id="first_name">
                                </div>
                                @if($errors->has('first_name'))
                                <div class="text-danger text-center">{{$errors->first('first_name')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">Last Name<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control custom-form" name="last_name" id="last_name">
                                </div>
                                @if($errors->has('last_name'))
                                <div class="text-danger text-center">{{$errors->first('last_name')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">Email</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control custom-form" name="email" id="email">
                                </div>
                                @if($errors->has('email'))
                                <div class="text-danger text-center">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">Phone No</label>
                                <div class="col-sm-3">
                                    <input type="number" class="form-control custom-form" name="phone_no" id="phone_no">
                                </div>
                                @if($errors->has('phone_no'))
                                <div class="text-danger text-center">{{$errors->first('phone_no')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-sm offset-sm-2">
                                    <button class="btn btn-primary">Add Employee</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection