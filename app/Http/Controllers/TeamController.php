<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TeamController extends Controller
{

    public function index()
    {
        return view("team.index");
    }

    public function create()
    {
        return view("team.create");
    }

    public function create_confirm()
    {
        return view("team.create_confirm");
    }

    public function store(Request $request)
    {
//        var_dump($request);
//        exit();
        return view("team.index");
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
