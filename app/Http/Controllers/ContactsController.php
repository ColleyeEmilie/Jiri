<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ContactsController extends Controller
{
    public function index()
    {
        $contacts = Contact::orderBy('name', 'desc')->get();

        return view('pages.contacts.index', compact('contacts'));
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

    public function edit(Contact $contact)
    {
        return view('pages.contacts.edit', compact('contact'));
    }

    public function update(Request $request, Contact $contact)
    {
        $contact->update($request->only('name', 'firstname', 'email'));

        return redirect('contacts');
    }

    public function destroy(Contact $contact)
    {
        //$contact->attendances()->delete();
        //$contact->implementations()->delete();
        $contact->delete();

        session()->flash('success', "$contact->name a bien été supprimé.");
        return redirect('contacts');
    }
}
