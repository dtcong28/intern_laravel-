@extends('main')
@section('title', 'Search Team')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Search Team</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="border border-primary">
            <form method="GET" class="p-4">
                <div class="form-group pb-3 col-6">
                    <label>Name *</label>
                    <input type="text" class="form-control" name="searchName"
                           value="{{ request()->get('searchName','') }}">
                </div>
                <div class="row">
                    <a href="{{ route('team.index')}}" class="btn btn-secondary col-1">Reset</a>
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
            <th scope="col">@sortablelink('name', 'Name')</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>
        @if ($teams->count() == 0)
            <tr>
                <td colspan="5">No result found.</td>
            </tr>
        @endif
        @if(!empty($teams))
            @foreach ($teams as $team)
                <tr>
                    <th scope="row">{{ $team['id'] }}</th>
                    <td>{{ $team['name'] }}</td>
                    <td>
                        <a href="{{ route('team.edit', $team->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form class="d-inline" method="post" action="{{route('team.destroy', $team->id)}}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm" onclick="return Confirm()">Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        @endif

        </tbody>
    </table>
    <div class="pagination-block">
        @if(!empty($teams))
            {{ $teams->links('layout.paginationlinks') }}
        @endif
    </div>
    </div>
@endsection
