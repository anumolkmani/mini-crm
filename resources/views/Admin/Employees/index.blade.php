@extends('layouts.admin')
@section('content')
<div id="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Employees</h5>
            <a href="{{ URL::to('employee/create') }}" class="btn btn-secondary"><span class="material-icons mr-2">New Employee</a>
        </div>
        @if (session('status'))
        <div class="alert alert-success text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('status') }}
        </div>
        @endif
        @if (session('error'))
        <div class="alert alert-danger text-center">
            <button type="button" class="close" data-dismiss="alert">×</button>
            {{ session('error') }}
        </div>
        @endif
        <div class="row mt-3">
            <div class="col-md">
                <div class="card custom-card">
                    <div class="card-body">
                        <div class="table-responsive p-1">
                            <table class="table table-hover custom-table" id="table1">
                                <thead>
                                    <tr>
                                        <th>Sl No</th>
                                        <th>Name</th>
                                        <th>Company</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($employees as $item)
                                    <tr>
                                        <td>{{$loop->index +1}}</td>
                                        <td>{{$item->first_name}} {{$item->last_name}}</td>
                                        <td>{{$item->getCompany['name']}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>{{$item->phone_no}}</td>
                                        <td>
                                            <a href="{{ URL::to('employee/'.$item->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{URL::to('employee',$item->id)}}" class="custom-forms" method="POST">
                                                @csrf
                                                <input type="hidden" name="_method" value="DELETE" />
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('scripts')
<script>
    $(document).ready(function() {
        $('#table1').DataTable();
    });
</script>
@endsection