<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campsite;

class UploadController extends Controller
{
    public function upload (Request $request) {

        $campsite = Campsite::find($request->id);
        $pathToFile = $request->file('image')->store('images', 'public');
        $campsite->img_path = $pathToFile;
        $campsite->save();
        return $pathToFile;

    }

    public function add (Request $request) {

        $pathToFile = $request->file('image')->store('images', 'public');
        return $pathToFile;

    }
}
