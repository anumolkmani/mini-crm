@extends('layouts.admin')
@section('content')
<div id="main">
    <div class="container-fluid">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <h5 class="mb-0">Companies</h5>
            <a href="{{ URL::to('company/create') }}" class="btn btn-secondary"><span class="material-icons mr-2">New Company</a>
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
                                        <th>Email</th>
                                        <th>Logo</th>
                                        <th>Action</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($companies as $item)
                                    <tr>
                                        <td>{{$loop->index +1}}</td>
                                        <td>{{$item->name}}</td>
                                        <td>{{$item->email}}</td>
                                        <td>
                                            @if($item->logo)
                                            <img src="/storage/{{ $item->id }}/{{ $item->logo}}" class="img-size-50 mr-3 img-circle" style="height: 50px;width: 80px;">
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ URL::to('company/'.$item->id.'/edit') }}" class="btn btn-sm btn-primary">Edit</a>
                                        </td>
                                        <td>
                                            <form action="{{URL::to('company',$item->id)}}" class="custom-forms" method="POST">
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