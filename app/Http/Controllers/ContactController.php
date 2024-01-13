<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $contacts = Contact::latest()->get();
            return view('modules.contact.index', ['title' => 'Contact List', 'contacts' => $contacts]);
        } catch (\Throwable $th) {
            throw $th;
        }
    }

  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {
            Contact::create([
                'name' => $request->name,
                'email' => $request->email,
                'subject' => $request->subject,
                'message' => $request->message,
            ]);
            return redirect()->back()->with('message', 'Contact form Submit, Admin as soon as possible contact to you');
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contact $contact)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        try {
            $contact = Contact::find($id);
            if ($contact->status == 1) {
                $contact->status = 0;
                $contact->save();
                return redirect()->back()->with('message', 'Status update successfully');
            } else {
                $contact->status = 1;
                $contact->save();
                return redirect()->back()->with('message', 'Status update successfully');
            }
        } catch (\Throwable $th) {
            throw $th;
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Contact $contact)
    {
        //
    }
}
