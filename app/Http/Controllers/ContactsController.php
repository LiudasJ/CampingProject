<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacts;

class ContactsController extends Controller
{
    public function store (Request $request) {

        $data = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'question' => 'required|max:255'
        ]);

        $contact = new Contacts();
        $contact->store($data);

        return response()->json(['result' => 'message sent'], 200);
    }
}
