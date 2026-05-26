<?php

namespace App\Http\Controllers;

use App\Models\ContactModel;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    //
    public function create()
    {
        return view('admin.contact.create');
    }
    public function index()
    {
        $contacts = ContactModel::get();
        return view('admin.contact.index', compact('contacts'));
    }
    public function store(Request $request)
    {
        $contacts = new ContactModel();
        $contacts->street = $request->input('street');
        $contacts->phone = $request->input('phone');
        $contacts->email = $request->input('email');
        $contacts->save();
        return redirect()->route('contact.index')->with('success', 'address updated successfully');
    }
    public function edit($id) {
        $contact = ContactModel::findOrFail($id);
        return view('admin.contact.edit', compact('contact'));
    }
    public function update(Request $request ,$id) {
        $contact = ContactModel::findOrFail($id);
        $contact->street = $request->input('street');
        $contact->phone = $request->input('phone');
        $contact->email = $request->input('email');
        $contact->facebook = $request->input('facebook');
        $contact->twitter = $request->input('twitter');
        $contact->instagram = $request->input('instagram');
        $contact->linkedin = $request->input('linkedin');
        $contact->save();
        return redirect()->route('contact.edit', $contact->id)->with('success', 'contact updated successfully ');
    }
    public function destroy(Request $request , $id) {
        $contact = ContactModel::findOrFail($id);
        $contact->delete();
        return redirect()->route('contact.index')->with('success', 'contact deleted successfully ');
    }
}
