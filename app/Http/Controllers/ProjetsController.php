<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjetsController extends Controller
{
    public function index()
    {
        $projets = Project
            ::orderBy('created_at','asc')
            ->get();

        return view('pages.projets.index', compact('projets'));
    }

    public function create()
    {
        info('ProjetsController@index');
        return view('pages.projets.create');
    }

    public function store(Request $request)
    {
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
    }

    public function destroy($id)
    {
    }
}
