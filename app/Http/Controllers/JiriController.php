<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class JiriController extends Controller
{
    public function index()
    {
        $jiris = Jiri::orderBy('starting_at', 'asc')
            ->get();

        return view('pages.jiris.index', compact('jiris'));
    }

    public function show(Jiri $jiri)
    {
        return view('pages.jiris.show', compact('jiri'));
    }

    public function create(): View
    {
        info('JiriController@index');

        return view('pages.jiris.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => 'required',
            'starting_at' => 'required|date',
        ]);

        $jiri = auth()->user()->jiris()->create($data);

        if ($jiri) {
            session()->flash('success', "$jiri->name a bien été créé.");
        } else {
            session()->flash('error', 'Erreur lors de la création du Jiri.');
        }

        return redirect('jiris/create');
    }

    public function edit($jiriId)
    {
        $jiri = Jiri::findOrFail($jiriId);
        return view('pages.jiris.edit', compact('jiri'));
    }

    public function update(Request $request, $jiriId)
    {
        $jiri = Jiri::findOrFail($jiriId);
        $jiri->update(Request::all());

        return redirect('jiris');
    }

    public function destroy($jiriId)
    {
        $jiri = Jiri::findOrFail($jiriId);
        $jiri->delete();

        session()->flash('success', "$jiri->name a bien été supprimé.");

        return redirect('jiris');
    }
}
