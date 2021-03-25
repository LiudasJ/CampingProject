<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campsite;

class AdminController extends Controller
{
    public function index() {
        return view('admin', [
            ["admin" => 'success']
        ]);
    }
    public function all() 
    {
        $camping = new Campsite();
        return response()->json(["campings" => $camping->allCamps()], 200);
    }

    public function delete($id)
    {
        $campsite = Campsite::find($id);
        $campsite->delete();

        return response()->json(["result" => "camping with id: $id deleted successfuly"], 200);

    }

    public function edit($id)
    {
        $campsite = Campsite::find($id);

        $tags = $campsite->tags;

        $response = ['campsite' => $campsite, 'tags' => $tags];

        return view('update', [
            "campsite" => $campsite,
            "tags" => $tags
        ]);

    }
}
