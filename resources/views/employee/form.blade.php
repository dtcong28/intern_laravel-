@extends('main')
@if(empty($employee))
    @section('title', 'Create Employee')
@else
    @section('title', 'Edit Employee')
@endif

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    @if(empty($employee))
                        <h1 class="m-0">Create Employee</h1>
                    @else
                        <h1 class="m-0">Edit Employee</h1>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        {{session()->forget('employee')}}
        <form method="POST"
              action=" @if(!empty($employee->id)){{route("employee_edit_confirm")}}@else{{route("employee_create_confirm")}} @endif"
              class="col" enctype="multipart/form-data">
            @csrf
            <div class=" row border border-secondary">
                <div class="m-2">
                    @if(!empty($employee))
                        <div class="form-group ">
                            <label>ID</label>
                            <input type="text" class="form-control col-4" name="id" value="{{$employee->id}}"
                                   readonly>
                        </div>
                    @endif
                    <div class="form-group">
                        <label>Avatar *</label><br>
                        <input type="file" class="form-control-file" name="upload_file" id="upload" onchange="loadFile(event)">
                        @if(isset($employee))
                            <input type="hidden"name="avatar" value="{{$employee->avatar}}">
                        @endif
                        <img style="width: 90px;" id="output" @if(isset($employee)) src="{{ asset('storage/uploads/employees/'.$employee->avatar) }}" @endif>
                    </div>
                    <div class="form-group">
                        <label>Team *</label><br>
                        <select class="form-select col-4" name="team_id">
                            @if(!empty($teams))
                                <option>Open this to select team</option>
                            @endif
                            @foreach($teams as $team)
                                <option value="{{$team->id}}"
                                        @if(isset($employee) && ($team->id == $employee->team_id)) selected @endif >{{$team->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>First name *</label>
                        <input type="text" class="form-control col-4" name="first_name"
                               value="@if(!empty($employee)){{$employee->first_name}}@endif">
                    </div>
                    <div class="form-group">
                        <label>Last name *</label>
                        <input type="text" class="form-control col-4" name="last_name"
                               value="@if(!empty($employee)){{ $employee->last_name }}@endif">
                    </div>
                    <div class="form-group">
                        <label>Gmail *</label>
                        <input type="text" class="form-control col-4" name="email"
                               value="@if(!empty($employee)){{ $employee->email }}@endif">
                    </div>
                    <div class="form-group">
                        <label>Gender *</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="{{config('constants.gender.MALE') }}"
                                   @if(isset($employee) && $employee->gender == config('constants.gender.MALE')) checked @endif>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="{{config('constants.gender.FEMALE')}}"
                                   @if(isset($employee) && $employee->gender == config('constants.gender.FEMALE')) checked @endif>
                            <label class="form-check-label">Female</label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Birthday *</label>
                        <input type="date" class="form-control col-4" name="birthday"
                               value="@if(!empty($employee)){{$employee->birthday}}@endif">
                    </div>
                    <div class="form-group">
                        <label>Address *</label>
                        <input type="text" class="form-control col-4" name="address"
                               value="@if(!empty($employee)){{ $employee->address }}@endif">
                    </div>
                    <div class="form-group">
                        <label>Salary *</label>
                        <input type="number" class="form-control col-4" name="salary"
                               value="@if(!empty($employee)){{ $employee->salary }}@endif"> VND
                    </div>
                    <div class="form-group">
                        <label>Position *</label><br>
                        <select class="form-select col-4" name="position">
                            <option>Open this to select position</option>
                            <option value="{{config('constants.position.MANAGER')}}" @if(isset($employee) && ($employee->position == config('constants.position.MANAGER'))) selected @endif>Manager</option>
                            <option value="{{config('constants.position.TEAM_LEADER')}}" @if(isset($employee) && ($employee->position == config('constants.position.TEAM_LEADER'))) selected @endif >Team leader</option>
                            <option value="{{config('constants.position.BSE')}}" @if(isset($employee) && ($employee->position == config('constants.position.BSE'))) selected @endif>BSE</option>
                            <option value="{{config('constants.position.DEV')}}" @if(isset($employee) && ($employee->position == config('constants.position.DEV'))) selected @endif>Dev</option>
                            <option value="{{config('constants.position.TESTER')}}" @if(isset($employee) && ($employee->position == config('constants.position.TESTER'))) selected @endif>Tester</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Type of work *</label><br>
                        <select class="form-select col-4" name="type_of_work">
                            <option>Open this to select type of work</option>
                            <option value="{{config('constants.typeWork.FULLTIME')}}" @if(isset($employee) && ($employee->type_of_work == config('constants.typeWork.FULLTIME'))) selected @endif>Fulltime</option>
                            <option value="{{config('constants.typeWork.PARTIME')}}" @if(isset($employee) && ($employee->type_of_work == config('constants.typeWork.PARTIME'))) selected @endif>Partime</option>
                            <option value="{{config('constants.typeWork.PROBATIONARY_STAFF')}}" @if(isset($employee) && ($employee->type_of_work == config('constants.typeWork.PROBATIONARY_STAFF'))) selected @endif>Probationary Staff</option>
                            <option value="{{config('constants.typeWork.INTERN')}}" @if(isset($employee) && ($employee->type_of_work == config('constants.typeWork.INTERN'))) selected @endif>Intern</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Status *</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status"
                                   value="{{config('constants.status.ON_WORKING')}}" @if(isset($employee) && $employee->status == config('constants.status.ON_WORKING')) checked @endif>
                            <label class="form-check-label">On working</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="status"
                                   value="{{config('constants.status.RETIRED')}}" @if(isset($employee) && $employee->status == config('constants.status.RETIRED')) checked @endif>
                            <label class="form-check-label">Retired</label>
                        </div>
                    </div>

                </div>
            </div>

            <div class="row pt-2">
                <button type="reset" name="reset" class="btn btn-secondary col-1">Reset</button>
                <div class="col-10"></div>
                <button type="submit" name="confirm" class="btn btn-primary col-1">Confirm
                </button>
            </div>

        </form>
    </div>
@endsection
