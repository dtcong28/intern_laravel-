<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Repository\Eloquent\EmployeeRepository;
use App\Repository\Eloquent\TeamRepository;
use App\Http\Requests\Employee\EmployeeRequest;


class EmployeeController extends Controller
{
    protected $teamRepository;
    protected $employeeRepository;

    public function __construct(TeamRepository $teamRepository, EmployeeRepository $employeeRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function index()
    {
        return view('employee.index',[
            'employees' => $this->employeeRepository->paginate(),
            'teams' => $this->teamRepository->getAll(),
        ]);
    }

    public function create()
    {
        return view("employee.form", ['teams' => $this->teamRepository->getAll()]);
    }

    public function create_confirm(EmployeeRequest $request)
    {
        if($request->has("upload_file")) {
            $file = $request->upload_file;
            $ext = $file->extension();
            $file_name = time().'-'.'employee.'.$ext;
            $file->storeAs('public/uploads/employees', $file_name);
            $request->merge(['avatar'=>$file_name]);
        }
        $data = $request->except('upload_file');
        $request->session()->put('employee', $data);
        return view("employee.form_confirm", ['teams' => $this->teamRepository->getAll()]);
    }

    public function store(EmployeeRequest $request)
    {
        $this->employeeRepository->save(session()->pull('employee'));
        return redirect()->route('employee.index')->with('success', config('constants.messages.CREATE_SUCCESS'));
    }

    public function edit($id)
    {
        if (!$employee = $this->employeeRepository->findById($id)) {
            return redirect()->route('employee.index')->with('warning', config('constants.messages.NO_DATA'));
        }
        return view('employee.form', ['employee' => $employee, 'teams' => $this->teamRepository->getAll()]);
    }

    public function edit_confirm(EmployeeRequest $request)
    {
        if($request->has("upload_file")) {
            $file = $request->upload_file;
            $ext = $file->extension();
            $file_name = time().'-'.'employee.'.$ext;
            $file->storeAs('public/uploads/employees', $file_name);
            $request->merge(['avatar'=>$file_name]);
        } else {
            $request->merge(['avatar'=>$request['avatar']]);
        }

        $data = $request->except('upload_file');
        $request->session()->put('employee', $data);
        return view("employee.form_confirm",['teams' => $this->teamRepository->getAll()]);
    }

    public function update(EmployeeRequest $request, $id)
    {
        $this->employeeRepository->save(session()->pull('employee'), ['id' => $id]);
        return redirect()->route('employee.index')->with('success',  config('constants.messages.UPDATE_SUCCESS'));
    }

    public function show($id)
    {
        //
    }

    public function destroy($id)
    {
        $this->employeeRepository->deleteById($id);
        return redirect()->route('employee.index')->with('success', config('constants.messages.DELETE_SUCCESS'));
    }
}
