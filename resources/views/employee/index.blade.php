@extends('main')
@section('title', 'Search Employees')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Search Employee</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="border border-primary">
            <form method="GET" class="p-4">
                <div class="form-group col-5">
                    <label>Team *</label><br>
                    <select class="form-select col-7" name="team_id">
                        @if(!empty($teams))
                            <option value="">Open this to select team</option>
                        @endif
                        @foreach($teams as $team)
                            <option value="{{$team->id}}" {{ $team->id == request()->get('team_id') ? 'selected' : '' }} >{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-5">
                    <label>Name *</label>
                    <input type="text" class="form-control" name="searchName" value="{{ request()->get('searchName','') }}">
                </div>
                <div class="form-group col-5">
                    <label>Email *</label>
                    <input type="text" class="form-control" name="searchEmail" value="{{ request()->get('searchEmail','') }}">
                </div>
                <div class="row">
                    <a href="{{route('employee.index')}}" class="btn btn-secondary col-1">Reset</a>
                    <div class="col-10"></div>
                    <button type="search" class="btn btn-primary col-1">Search</button>
                </div>
            </form>
        </div>

    </div>
    <div class="row pt-2">
        <div class="col-9"></div>
        <a class="btn btn-primary col-2" href="{{ route('employee.export_file') }}">Export CSV</a>
    </div>

    <table class="table mt-3">

        <thead class="thead-dark">
        <tr>
            <th scope="col">@if ($employees->count() == 0) ID @else @sortablelink('id', 'ID') @endif</th>
            <th scope="col">@if ($employees->count() == 0) Team @else @sortablelink('team_id', 'Team') @endif</th>
            <th scope="col">@if ($employees->count() == 0) Name @else @sortablelink('last_name', 'Name') @endif</th>
            <th scope="col">@if ($employees->count() == 0) Email @else @sortablelink('email', 'Email') @endif</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @if ($employees->count() == 0)
            <tr>
                <td colspan="5">No result found.</td>
            </tr>
        @endif
        @if(!empty($employees))
            @foreach ($employees as $employee)
                <tr>
                    <th scope="row">{{ $employee->id }}</th>
                    <td>{{ $employee->team->name }}</td>
                    <td>{{ $employee->full_name }}</td>
                    <td>{{ $employee->email }}</td>
                    <td>
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form class="d-inline" method="post" action="{{route('employee.destroy', $employee->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#modal-default">
                                Delete
                            </button>
                            <div class="modal fade" id="modal-default">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h4 class="modal-title">Confirm</h4>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Are you sure ?</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                            <form action="{{route('employee.destroy', $team->id)}}" method="POST" style="display: inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary">Delete</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(!empty($employees))
    {{ $employees->links('layout.paginationlinks') }}
    @endif
    </div>
@endsection
