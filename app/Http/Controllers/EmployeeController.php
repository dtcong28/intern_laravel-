<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Repository\Eloquent\EmployeeRepository;
use App\Repository\Eloquent\TeamRepository;
use App\Http\Requests\Employee\EmployeeRequest;
use Illuminate\Support\Facades\Log;


class EmployeeController extends Controller
{
    protected $teamRepository;
    protected $employeeRepository;

    public function __construct(TeamRepository $teamRepository, EmployeeRepository $employeeRepository)
    {
        $this->teamRepository = $teamRepository;
        $this->employeeRepository = $employeeRepository;
    }

    public function index(EmployeeRequest $request)
    {
        $listTeam = $this->teamRepository->getAll();

        $teamId = $request->get('team_id');
        $searchName = $request->get('searchName');
        $searchEmail = $request->get('searchEmail');

        // Xử lý N+1 trong findByTeamOrNameOrEmail
        $result = $this->employeeRepository->findByTeamOrNameOrEmail($teamId, $searchName, $searchEmail);
        $result->appends($request->all());

        return view('employee.index', [
            'employees' => $result,
            'teams' => $listTeam,
        ]);
    }

    public function create()
    {
        return view("employee.form", ['teams' => $this->teamRepository->getAll()]);
    }

    public function createConfirm(EmployeeRequest $request)
    {
        uploadImg($request);
        $data = $request->except('upload_file');
        $request->session()->put('employee', $data);

        $teams = $this->teamRepository->getAll();
        return view("employee.form_confirm", ['teams' => $teams]);
    }

    public function store(EmployeeRequest $request)
    {
        try {
            $employee = session()->pull('employee');
            $storedEmployee = $this->employeeRepository->save($employee);

            SendWelcomeEmail::dispatch($storedEmployee)->delay(now()->addMinute(1));

            return redirect()->route('employee.index')->with('success', config('constants.messages.CREATE_SUCCESS'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('employee.index')->with('fail', config('constants.messages.CREATE_FAIL'));
        }
    }

    public function edit($id)
    {
        try {
            $employee = $this->employeeRepository->findById($id);
            $teams = $this->teamRepository->getAll();

            if (empty($employee)) {
                return redirect()->route('employee.index')->with('warning', config('constants.messages.NO_DATA'));
            }
            return view('employee.form', ['employee' => $employee, 'teams' => $teams]);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('employee.index')->with('fail', config('constants.messages.EDIT_FAIL'));
        }

    }

    public function editConfirm(EmployeeRequest $request)
    {
        uploadImg($request);
        $data = $request->except('upload_file');
        $request->session()->put('employee', $data);

        $teams = $this->teamRepository->getAll();
        return view("employee.form_confirm", ['teams' => $teams]);
    }

    public function update(EmployeeRequest $request, $id)
    {
        try {
            $employee = session()->pull('employee');
            $employee_id = $this->employeeRepository->findById($id);

            if (empty($employee_id)) {
                return redirect()->route('employee.index')->with('warning', config('constants.messages.NO_DATA'));
            }

            $this->employeeRepository->save($employee, ['id' => $id]);
            return redirect()->route('employee.index')->with('success', config('constants.messages.UPDATE_SUCCESS'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('employee.index')->with('fail', config('constants.messages.UPDATE_FAIL'));
        }
    }

    public function destroy($id)
    {
        try {
            $employee_id = $this->employeeRepository->findById($id);

            if (empty($employee_id)) {
                return redirect()->route('employee.index')->with('warning', config('constants.messages.NO_DATA'));
            }

            $this->employeeRepository->deleteById($id);
            return redirect()->route('employee.index')->with('success', config('constants.messages.DELETE_SUCCESS'));
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->route('employee.index')->with('fail', config('constants.messages.DELETE_FAIL'));
        }
    }
}
