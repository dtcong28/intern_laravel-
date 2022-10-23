@extends('main')
@if(!session()->has('employee.id'))
    @section('title', 'Create confirm')
@else
    @section('title', 'Edit confirm')
@endif
@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(!session()->has('employee.id'))
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
              action="@if(session()->has('employee.id')) {{route("employee.update",session()->get('employee.id'))}} @else {{route("employee.store")}} @endif"
              class="col">
            @if(session()->has('employee.id'))
                @method('PATCH')
            @endif
            @csrf
            <div class="row border border-secondary">
                <div class="m-2">
                    @if(session()->has('employee.id'))
                        <div class="form-group ">
                            <label>ID *</label>
                            <span>{{session()->get('employee.id')}}</span>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Avatar *</label><br>
                        @if(session()->has('employee.avatar'))
                            <img style="width: 90px"
                                 src="{{ asset('storage/uploads/employees/'. session()->get('employee.avatar') ) }}"/>
                        @endif
                    </div>
                    <div class="form-group">
                        <label>Team *</label>
                        <span>@foreach($teams as $team)@if(session()->get('employee.team_id') == $team->id){{$team->name}}@endif @endforeach</span>
                    </div>
                    <div class="form-group">
                        <label>First name *</label>
                        <span>{{session()->get('employee.first_name')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Last name *</label>
                        <span>{{session()->get('employee.last_name')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Gmail *</label>
                        <span>{{session()->get('employee.email')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Gender *</label>
                        <span>@if(session()->get('employee.gender') == config('constants.gender.MALE')) Male @else
                                Female @endif</span>
                    </div>
                    <div class="form-group">
                        <label>Birthday *</label>
                        <span>{{session()->get('employee.birthday')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Address *</label>
                        <span>{{session()->get('employee.address')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Salary *</label>
                        <span>{{session()->get('employee.salary')}}</span>
                    </div>
                    <div class="form-group">
                        <label>Position *</label>
                        <span>@if(session()->get('employee.position') == config('constants.position.MANAGER'))
                                Manager @elseif(session()->get('employee.position') == config('constants.position.TEAM_LEADER'))
                                Team
                                leader @elseif(session()->get('employee.position') == config('constants.position.BSE'))
                                Bse @elseif(session()->get('employee.position') == config('constants.position.DEV'))
                                Dev @else Tester @endif</span>
                    </div>
                    <div class="form-group">
                        <label>Type of work *</label>
                        <span>@if(session()->get('employee.type_of_work') == config('constants.typeWork.FULLTIME'))
                                Fulltime @elseif(session()->get('employee.type_of_work') == config('constants.typeWork.PARTIME'))
                                Partime @elseif(session()->get('employee.type_of_work') == config('constants.typeWork.PROBATIONARY_STAFF'))
                                Probationay staff @else Intern @endif</span>
                    </div>
                    <div class="form-group">
                        <label>Status *</label>
                        <span>@if(session()->get('employee.status') == config('constants.status.ON_WORKING')) On
                            working @else Retired @endif</span>
                    </div>

                </div>
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
                                <form action="{{ route('employee.store') }}" method="POST" style="display: inline-block">
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
