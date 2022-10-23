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
            <th scope="col">@if ($teams->count() == 0) ID @else @sortablelink('id', 'ID')@endif</th>
            <th scope="col">@if ($teams->count() == 0) Name @else @sortablelink('name', 'Name')@endif</th>
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
                                        <form action="{{route('team.destroy', $team->id)}}" method="POST" style="display: inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-primary">Delete</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
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
