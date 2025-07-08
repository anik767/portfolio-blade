<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use Illuminate\Support\Facades\Log;
class ContactController extends Controller
{
    // Submit contact form
    public function submit(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'message' => 'required|string',
        ]);

        try {
            $contact = Contact::create($validated);

            return response()->json([
                'message' => 'Contact form submitted and saved successfully',
                'contact' => $contact,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to save contact data',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    // Get all contacts
    public function index()
{
    try {
        $contacts = Contact::orderBy('created_at', 'desc')->get();

        return response()->json($contacts, 200);
    } catch (\Exception $e) {
        Log::error('Failed to fetch contacts', [
            'error' => $e->getMessage(),
        ]);

        return response()->json([
            'message' => 'Failed to fetch contacts',
            'error' => $e->getMessage(),
        ], 500);
    }
}



    // Delete a contact by id
    public function destroy($id)
    {
        try {
            $contact = Contact::findOrFail($id);
            $contact->delete();

            return response()->json([
                'message' => 'Contact deleted successfully',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Failed to delete contact',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
