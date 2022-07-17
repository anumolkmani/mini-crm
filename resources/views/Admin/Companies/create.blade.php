@extends('layouts.admin')
@section('content')
<div id="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-start align-items-center mb-4">
            <h5 class="mb-0">Add Company</h5>
        </div>
        <div class="row mt-3">
            <div class="col-md">
                <div class="card custom-card">
                    <div class="card-body">
                        <form action="{{ URL::to('company') }}" class="custom-forms" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">Company Name<span class="text-danger">*</span></label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control custom-form" name="companyName" id="" required>
                                </div>
                                @if($errors->has('companyName'))
                                <div class="text-danger text-center">{{$errors->first('companyName')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">Email</label>
                                <div class="col-sm-3">
                                    <input type="text" class="form-control custom-form" name="email" id="emailk">
                                </div>
                                @if($errors->has('email'))
                                <div class="text-danger text-center">{{$errors->first('email')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <label class="col-sm-2">Logo</label>
                                <div class="col-sm-3">
                                    <input type="file" class="form-control custom-form" name="logo" id="logo">
                                </div>
                                @if($errors->has('logo'))
                                <div class="text-danger text-center">{{$errors->first('logo')}}</div>
                                @endif
                            </div>
                            <div class="form-group row align-items-center">
                                <div class="col-sm offset-sm-2">
                                    <button class="btn btn-primary">Add Company</button>
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