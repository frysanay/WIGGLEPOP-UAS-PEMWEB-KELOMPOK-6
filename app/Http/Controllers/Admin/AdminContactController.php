<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class AdminContactController extends Controller
{
    public function index(Request $request)
    {
        $query = Contact::orderBy('created_at', 'desc');

        if ($request->filled('filter')) {
            $query->where('is_read', $request->filter === 'read');
        }

        $contacts = $query->paginate(15)->withQueryString();
        return view('admin.contacts.index', compact('contacts'));
    }

    public function show(Contact $contact)
    {
        if (!$contact->is_read) {
            $contact->update(['is_read' => true]);
        }
        return view('admin.contacts.show', compact('contact'));
    }

    public function markRead(Contact $contact)
    {
        $contact->update(['is_read' => true]);
        return back()->with('success', 'Pesan ditandai sudah dibaca.');
    }

    public function destroy(Contact $contact)
    {
        $contact->delete();
        return back()->with('success', 'Pesan berhasil dihapus.');
    }

    public function create() { return redirect()->route('admin.contacts.index'); }
    public function store(Request $request) { return redirect()->route('admin.contacts.index'); }
    public function edit(Contact $contact) { return redirect()->route('admin.contacts.index'); }
    public function update(Request $request, Contact $contact) { return redirect()->route('admin.contacts.index'); }
}
