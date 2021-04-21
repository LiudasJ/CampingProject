<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Images;
use App\Models\Campsite;
use Illuminate\Support\Facades\Validator;
use Session;

class ImagesController extends Controller
{
    public function index () 
    {

        $camping = new Campsite();
        
        return view('photos', [
            "campings" => $camping->allCamps()
        ]);
    }

    public function store (Request $req) {

        $validator = Validator::make($req->all(), [
            'campId' => 'required',
            'file' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect('admin/photos')
                        ->withErrors($validator);
        }

        $camping = $req->campId;
        $images = new Images();
        $pathToFile = $req->file('file')->store('images', 'public');
        $images->oneImgStore($pathToFile, $camping);
        
        Session::flash('success', 'Image uploaded successfuly');
        return redirect()->back();

    }

}
