@extends('main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Team</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form method="POST" action="{{route("team_confirm")}}" class="col">
            <div class="form-group p-5 border border-secondary row">
                <label>Name</label>
                <input type="text" class="form-control col-4" name="name">
            </div>
            <div class="row">
                <button type="reset" name="reset" class="btn btn-secondary col-1">Reset</button>
                <div class="col-10"></div>
                <button type="submit" name="confirm" class="btn btn-primary col-1">Confirm</button>
            </div>
            @csrf
        </form>
    </div>
@endsection
