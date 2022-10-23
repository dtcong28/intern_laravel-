@extends('main')
@if(empty($team))
    @section('title', 'Create Team')
@else
    @section('title', 'Edit Team')
@endif

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(empty($team))
                        <h1 class="m-0">Create Team</h1>
                    @else
                        <h1 class="m-0">Edit Team</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form method="POST"
              action=" @if(!empty($team->id)) {{route("team_edit_confirm")}} @else {{route("team_create_confirm")}} @endif"
              class="col">
            <div class=" row border border-secondary">
                @if(!empty($team))
                    <div class="form-group p-3 ">
                        <label>ID</label>
                        <input type="text" class="form-control col-4" name="id" value="{{ $team->id }}" readonly>
                    </div>
                @endif
                <div class="form-group p-3">
                    <label>Name</label>
                    <input type="text" class="form-control col-4" name="name"
                           value="@if(old('name')){{old('name')}} @elseif(!empty($team)) {{$team->name}}  @endif">
                    @error('name')
                    <span style="color: red">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="row pt-2">
                <a href="{{route('team.create')}}" class="btn btn-secondary col-1">Reset</a>
                <div class="col-10"></div>
                <button type="submit" name="confirm" class="btn btn-primary col-1">Confirm
                </button>
            </div>
            @csrf
        </form>
    </div>
@endsection
