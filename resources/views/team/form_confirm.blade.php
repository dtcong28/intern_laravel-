@extends('main')
@if(!session()->has('team.id'))
    @section('title', 'Create confirm')
@else
    @section('title', 'Edit confirm')
@endif
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!session()->has('team.id'))
                        <h1 class="m-0">Create Confirm</h1>
                    @else
                        <h1 class="m-0">Edit Confirm</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form method="POST"
              action="@if(session()->has('team.id')) {{route("team.update",session()->get('team.id'))}} @else {{route("team.store")}} @endif"
              class="col">
            @if(session()->has('team.id'))
                @method('PATCH')
            @endif
            @csrf
            <div class="form-group p-5 border border-secondary row">
                @if(session()->has('team.id'))
                    <label>ID</label>
                    <span>{{session()->get('team.id')}}</span>
                @endif
                <label>Name</label>
                <span>{{session()->get('team.name')}}</span>
            </div>

            <div class="row">
                <a href="{{url()->previous()}}" class="btn btn-secondary col-1">Back</a>
                <div class="col-10"></div>
                <button type="button" class="btn btn-primary col-1" data-toggle="modal" data-target="#modal-default">
                    Save
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
                                <form action="{{ route('team.store') }}" method="POST" style="display: inline-block">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </form>
    </div>
@endsection
