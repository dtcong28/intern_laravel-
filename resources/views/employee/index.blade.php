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
                    <select class="form-select col-6" name="team_id">
                        @if(!empty($teams))
                            <option value="">Open this to select team</option>
                        @endif
                        @foreach($teams as $team)
                            <option value="{{$team->id}}">{{$team->name}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group col-5">
                    <label>Name *</label>
                    <input type="text" class="form-control" name="searchName">
                </div>
                <div class="form-group col-5">
                    <label>Email *</label>
                    <input type="text" class="form-control" name="searchEmail">
                </div>
                <div class="row">
                    <button type="reset" class="btn btn-secondary col-1">Reset</button>
                    <div class="col-10"></div>
                    <button type="search" class="btn btn-primary col-1">Search</button>
                </div>
            </form>
        </div>
    </div>

    <table class="table mt-5">

        <thead class="thead-dark">
        <tr>
            <th scope="col">@sortablelink('id', 'ID')</th>
            <th scope="col">@sortablelink('team_id', 'Team')</th>
            <th scope="col">@sortablelink('last_name', 'Name')</th>
            <th scope="col">@sortablelink('email', 'Email')</th>
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
                    <th scope="row">{{ $employee['id'] }}</th>
                    <td>@foreach($teams as $team)@if($employee['team_id'] == $team->id){{$team->name}}@endif @endforeach</td>
                    <td>{{ $employee['full_name'] }}</td>
                    <td>{{ $employee['email'] }}</td>
                    <td>
                        <a href="{{ route('employee.edit', $employee->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form class="d-inline" method="post" action="{{route('employee.destroy', $employee->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return Confirm()">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif
        </tbody>
    </table>
    @if(!empty($employees))
    {{ $employees->links() }}
    @endif
    </div>
@endsection
