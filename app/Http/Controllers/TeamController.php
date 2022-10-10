<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Repository\Eloquent\TeamRepository;
use App\Http\Requests\Team\TeamRequest;

class TeamController extends Controller
{
    protected $teamRepository;

    public function __construct(TeamRepository $teamRepository)
    {
        $this->teamRepository = $teamRepository;
    }

    public function index()
    {
        return view('team.index', [
            'teams' => $this->teamRepository->paginate()
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
        $this->teamRepository->save(session()->pull('team'));
        return redirect()->route('team.index')->with('success', config('constants.messages.CREATE_SUCCESS'));
    }

    public function edit($id)
    {
        if (!$team = $this->teamRepository->findById($id)) {
            return redirect()->route('team.index')->with('warning', config('constants.messages.NO_DATA'));
        }
        return view('team.form', ['team' => $team]);
    }

    public function edit_confirm(TeamRequest $request)
    {
        $data = $request->all();
        $request->session()->put('team', $data);
        return view("team.form_confirm");
    }

    public function update(TeamRequest $request, $id)
    {
        $this->teamRepository->save(session()->pull('team'), ['id' => $id]);
        return redirect()->route('team.index')->with('success',  config('constants.messages.UPDATE_SUCCESS'));
    }

    public function destroy($id)
    {
        $this->teamRepository->deleteById($id);
        return redirect()->route('team.index')->with('success', config('constants.messages.DELETE_SUCCESS'));
    }

    public function show($id)
    {
        //
    }



}
