<?php

namespace App\Http\Controllers;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact
            ::orderBy('name','desc')->get();

        return view('pages.contacts.index',compact('contacts'));
    }

    public function show(Contact $contact)
    {
        return view('pages.contacts.show', compact('contact'));
    }
    public function create()
    {
        info('ContactController@index');
        return view('pages.contacts.create');
    }

    public function store(): RedirectResponse
    {
        return redirect('contacts');
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
