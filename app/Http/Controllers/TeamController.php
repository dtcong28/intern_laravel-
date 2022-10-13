<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Repository\Eloquent\TeamRepository;
use App\Http\Requests\Team\TeamRequest;
use Illuminate\Support\Collection;

use Illuminate\Contracts\Support\Jsonable;


class TeamController extends Controller
{
    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index(TeamRequest $request)
    {
        $searchName = isset($_GET['searchName']) ? $_GET['searchName'] : '';
        $result = $this->teamRepository->findByName(trim($searchName));
        $result->appends($request->all());
        return view('team.index', [
            'teams' => $result
        ]);
    }

    public function create()
    {
        return view("team.form");
    }

    public function create_confirm(TeamRequest $request)
    {
        $data = $request->all();
        $request->session()->put('team', $data);
        return view("team.form_confirm");
    }

    public function store(TeamRequest $request)
    {
        try {
            $team = session()->pull('team');
            $this->teamRepository->save($team);
            return redirect()->route('team.index')->with('success', config('constants.messages.CREATE_SUCCESS'));
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('fail', config('constants.messages.CREATE_FAIL'));
        }
    }

    public function edit($id)
    {
        try {
            $team = $this->teamRepository->findById($id);
            if (empty($team)) {
                return redirect()->route('team.index')->with('warning', config('constants.messages.NO_DATA'));
            }
            return view('team.form', ['team' => $team]);
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('fail', config('constants.messages.EDIT_FAIL'));
        }

    }

    public function edit_confirm(TeamRequest $request)
    {
        $data = $request->all();
        $request->session()->put('team', $data);
        return view("team.form_confirm");
    }

    public function update(TeamRequest $request, $id)
    {
        try {
            $team = session()->pull('team');

            $team_id = $this->teamRepository->findById($id);
            if (empty($team_id)) {
                return redirect()->route('team.index')->with('warning', config('constants.messages.NO_DATA'));
            }

            $this->teamRepository->save($team, ['id' => $id]);
            return redirect()->route('team.index')->with('success', config('constants.messages.UPDATE_SUCCESS'));
        } catch (\Exception $e) {
            return redirect()->route('team.index')->with('fail', config('constants.messages.UPDATE_FAIL'));
        }

    }

    public function destroy($id)
    {
        try {
            $team_id = $this->teamRepository->findById($id);
            if (empty($team_id)) {
                return redirect()->route('team.index')->with('warning', config('constants.messages.NO_DATA'));
            }

            $this->teamRepository->deleteById($id);
            return redirect()->route('team.index')->with('success', config('constants.messages.DELETE_SUCCESS'));
        } catch (\Exception $e){
            return redirect()->route('team.index')->with('fail', config('constants.messages.DELETE_FAIL'));
        }
    }

}
