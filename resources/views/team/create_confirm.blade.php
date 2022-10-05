@extends('main')
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Create Confirm</h1>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <form method="POST" action="{{route("team.store")}}" class="col">
            @csrf
            <div class="form-group p-5 border border-secondary row">
                <label >Name</label>
                <input name="confirm_name" type="text" class="form-control col-4" value="{{$_POST["name"]}}" readonly>
            </div>
            <div class="row">
                <button  onclick="history.go(-1)" name="back" class="btn btn-secondary col-1">Back</button>
                <div class="col-10"></div>
                <button type="submit" name="save" class="btn btn-primary col-1">Save</button>
            </div>

        </form>
    </div>
@endsection
