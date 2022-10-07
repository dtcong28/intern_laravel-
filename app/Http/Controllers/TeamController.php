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

    public function create_confirm()
    {
        return view("team.form_confirm",['name' => $_POST["name"]]);
    }

    public function store(TeamRequest $request)
    {
        $this->teamRepository->save($request->all());
        return redirect()->route('team.index')->with('success', 'Successfully added new');
    }

    public function edit($id)
    {
        if (!$team = $this->teamRepository->findById($id)) {
            abort(404);
        }
        return view('team.form', ['team' => $team]);
    }

    public function edit_confirm()
    {
        return view("team.form_confirm",['name' => $_POST["name"], 'id' => $_POST["id"]]);
    }

    public function update(TeamRequest $request, $id)
    {
        $this->teamRepository->save($request->all(), ['id' => $id]);
        return redirect()->route('team.index')->with('success', 'Successfully updated');
    }

    public function destroy($id)
    {
        $this->teamRepository->deleteById($id);
        return redirect()->route('team.index')->with('success', 'Delete success.');
    }

    public function show($id)
    {
        //
    }



}
