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
                        {{session()->put('create_avatar',$employee->avatar)}}
                    @endif
                </div>
            </div>
        </div>
    </div>
    @if(!session()->has('errors'))
        {{session()->forget('create_avatar')}}
    @endif
    <div class="container-fluid">
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
                        <input type="file" class="form-control-file" name="upload_file" id="upload"
                               onchange="loadFile(event)">

                        @error('upload_file')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                        <br>

                        <input type="hidden" name="avatar"
                               value="@if(isset($employee) && !session()->has('employee')) {{$employee->avatar}} @elseif(session()->has('create_avatar') && session()->has('errors')){{session()->get('create_avatar')}}@elseif(session()->has('employee.avatar')){{session()->get('employee.avatar')}} @endif ">

                        <img style="width: 90px;" id="output"
                             @if(isset($employee) && !session()->has('employee')) src="{{ asset(config('constants.path.PATH_EMPLOYEE').$employee->avatar) }}"
                             @elseif(session()->has('employee.avatar')) src="{{ asset(config('constants.path.PATH_EMPLOYEE').session()->get('employee.avatar')) }}"
                             @elseif(session()->has('create_avatar') && !$errors->has('upload_file')) src="{{ asset(config('constants.path.PATH_EMPLOYEE').session()->get('create_avatar')) }}"@endif>
                    </div>
                    <div class="form-group">
                        <label>Team *</label><br>
                        <select class="form-select col-4" name="team_id">
                            @if(!empty($teams))
                                <option value="">Open this to select team</option>
                            @endif
                            @foreach($teams as $team)
                                <option value="{{$team->id}}"
                                        @if($team->id == old('team_id') || (isset($employee) && ($team->id == $employee->team_id) && !session()->has('employee')) ) selected @endif >{{$team->name}}</option>
                            @endforeach
                        </select>
                        @error('team_id')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>First name *</label>
                        <input type="text" class="form-control col-4" name="first_name"
                               value="@if(old('first_name')){{old('first_name')}} @elseif(!empty($employee)){{$employee->first_name}} @endif">
                        @error('first_name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Last name *</label>
                        <input type="text" class="form-control col-4" name="last_name"
                               value="@if(old('last_name')){{old('last_name')}} @elseif(!empty($employee)){{$employee->last_name}} @endif">
                        @error('last_name')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Gmail *</label>
                        <input type="text" class="form-control col-4" name="email"
                               value="@if(old('email')){{old('email')}} @elseif(!empty($employee)){{$employee->email}} @endif">
                        @error('email')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Gender *</label><br>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="{{config('constants.gender.MALE') }}"
                                   @if( (isset($employee) && $employee->gender == config('constants.gender.MALE')) || old('gender') == config('constants.gender.MALE')) checked @endif>
                            <label class="form-check-label">Male</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="gender"
                                   value="{{config('constants.gender.FEMALE')}}"
                                   @if((isset($employee) && $employee->gender == config('constants.gender.FEMALE')) || old('gender') == config('constants.gender.FEMALE')) checked @endif>
                            <label class="form-check-label">Female</label>
                        </div>
                        <br>
                        @error('gender')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Birthday *</label>
                        <input type="date" class="form-control col-4" name="birthday"
                               value="@if(old('birthday')){{old('birthday')}}@elseif(!empty($employee)){{$employee->birthday}}@endif">
                        @error('birthday')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Address *</label>
                        <input type="text" class="form-control col-4" name="address"
                               value="@if(old('address')){{old('address')}} @elseif(!empty($employee)){{$employee->address}} @endif">
                        @error('address')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Salary *</label>
                        <input type="number" class="form-control col-4" name="salary"
                               value="@if(old('salary')){{old('salary')}}@elseif(!empty($employee)){{$employee->salary}}@endif">VND
                        @error('salary')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Position *</label><br>
                        <select class="form-select col-4" name="position">
                            <option value="">Open this to select position</option>
                            @foreach(config('constants.position') as $position)
                                <option value="{{ $position }}"
                                        @if((isset($employee) && ($employee->position == $position) && !session()->has('employee')) || old('position') == $position) selected @endif>
                                    @if($position == config('constants.position.MANAGER'))
                                        Manager
                                    @elseif($position == config('constants.position.TEAM_LEADER'))
                                        Team leader
                                    @elseif($position == config('constants.position.BSE'))
                                        BSE
                                    @elseif($position == config('constants.position.DEV'))
                                        DEV
                                    @elseif($position == config('constants.position.TESTER'))
                                        Tester
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('position')
                        @if(old('position') == '')
                            <span style="color: red">{{ $message }}</span>
                        @endif
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Type of work *</label><br>
                        <select class="form-select col-4" name="type_of_work">
                            <option value="">Open this to select type of work</option>
                            @foreach(config('constants.typeWork') as $typeWork)
                                <option value="{{ $typeWork }}"
                                        @if((isset($employee) && ($employee->type_of_work == $typeWork) && !session()->has('employee')) || old('type_of_work') == $typeWork) selected @endif>
                                    @if($typeWork == config('constants.typeWork.FULLTIME'))
                                        Fulltime
                                    @elseif($typeWork == config('constants.typeWork.PARTIME'))
                                        Partime
                                    @elseif($typeWork == config('constants.typeWork.PROBATIONARY_STAFF'))
                                        Probationary Staff
                                    @elseif($typeWork == config('constants.typeWork.INTERN'))
                                        Intern
                                    @endif
                                </option>
                            @endforeach
                        </select>
                        @error('type_of_work')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label>Status *</label><br>
                        @foreach(config('constants.status') as $status)
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="status"
                                       value="{{$status}}"
                                       @if((isset($employee) && $employee->status == $status ) || old('status') == $status ) checked @endif>
                                <label class="form-check-label">@if($status == config('constants.status.ON_WORKING'))On
                                    working @elseif($status == config('constants.status.RETIRED'))Retired @endif</label>
                            </div>
                        @endforeach
                        <br>
                        @error('status')
                        <span style="color: red">{{ $message }}</span>
                        @enderror
                    </div>

                </div>
            </div>

            <div class="row pt-2">
                <a href="{{route('employee.create')}}" class="btn btn-secondary col-1">Reset</a>
                <div class="col-10"></div>
                <button type="submit" name="confirm" class="btn btn-primary col-1">Confirm
                </button>
            </div>
        </form>
        {{session()->forget('employee')}}
    </div>
@endsection
