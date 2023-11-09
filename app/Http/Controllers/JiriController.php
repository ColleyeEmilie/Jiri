<?php

namespace App\Http\Controllers;

use App\Models\Jiri;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Request;

class JiriController extends Controller
{
    public function index()
    {
        $jiris = Jiri
            ::orderBy('starting_at','asc')
            ->get();

        return view('pages.jiris.index', compact('jiris'));
    }

    public function create(): View
    {
        info('JiriController@index');
        return view('pages.jiris.create');
    }

    public function store(): RedirectResponse
    {
        $data = Request::validate([
            'name' => 'required',
            'starting_at' => 'required|date',
            'duration' => 'required|integer',
        ]);

        auth()->user()?->jiris()->create($data);
        return redirect('jiris');
    }
}
