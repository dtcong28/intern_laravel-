@extends('main')
@if(empty($id))
    @section('title', 'Create confirm')
@else
    @section('title', 'Edit confirm')
@endif
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(empty($id))
                        <h1 class="m-0">Create Confirm</h1>
                    @else
                        <h1 class="m-0">Edit Confirm</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form method="POST" action="@if(!empty($id)) {{route("team.update",$id)}} @else {{route("team.store")}} @endif"
              class="col">
            @if(!empty($id))
                @method('PATCH')
            @endif
            @csrf
            <div class="form-group p-5 border border-secondary row">
                <label>Name</label>
                <input name="name" type="text" class="form-control col-4" value="{{$name}}" readonly>
            </div>
            <div class="row">
                <a href="javascript:window.history.back();" class="btn btn-secondary col-1">Back</a>
                <div class="col-10"></div>
                <button type="submit" onclick="return Confirm()" name="save" class="btn btn-primary col-1">Save</button>
            </div>
        </form>
    </div>
@endsection
