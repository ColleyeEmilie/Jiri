<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjetsController extends Controller
{
    public function index()
    {
        $projects = Project
            ::orderBy('created_at','asc')
            ->get();
        return view('pages.projets.index', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('pages.projets.show', compact('project'));
    }

    public function create()
    {
        info('ProjetsController@index');
        return view('pages.projets.create');
    }

    public function store(): RedirectResponse
    {
        return redirect('projets');
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
