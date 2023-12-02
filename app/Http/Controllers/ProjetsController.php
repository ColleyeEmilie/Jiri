<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjetsController extends Controller
{
    public function index()
    {
        $projects = Project::orderBy('created_at', 'asc')
                ->get();

        return view('pages.projets.index', compact('projects'));
    }

    public function show($projectId)
    {
        $project = Project::findOrFail($projectId);

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

    public function edit($projectId)
    {
        $project = Project::findOrFail($projectId);

        return view('pages.projets.edit', compact('project'));
    }

    public function update(Request $request, $projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->update($request->only('name', 'link', 'ponderation', 'description'));

        return redirect('projets');
    }

    public function destroy($projectId)
    {
        $project = Project::findOrFail($projectId);
        $project->delete();

        return redirect('projets');
    }
}
