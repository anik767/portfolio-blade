<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    // Show contact form (public)
    public function showForm()
    {
        return view('site.contact_form');
    }

    // Submit contact form
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            Contact::create($validated);

            return redirect()->back()->with('success', 'Thank you for contacting us!');
        } catch (\Exception $e) {
            Log::error('Failed to save contact form: '.$e->getMessage());

            return redirect()->back()->withErrors('Failed to submit contact form. Please try again later.');
        }
    }

    // Admin: list contacts with pagination
    public function index()
    {
        $contacts = Contact::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.contacts', compact('contacts'));
    }

    // Admin: delete contact
    public function destroy($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();

            return redirect()->route('admin.contacts')->with('success', 'Contact deleted successfully');
        } catch (\Exception $e) {
            return redirect()->route('admin.contacts')->withErrors('Failed to delete contact');
        }
    }
}
