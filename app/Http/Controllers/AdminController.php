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

    public function store (Request $request)
    {

        $this->validateCamping();

        $campsite = new Campsite();

        $campsite->name = $request->name;
        $campsite->country = $request->country;
        $campsite->city = $request->city;
        $campsite->website = $request->website;
        $campsite->rating = $request->rating;
        $campsite->img_path = $request->image;

        $campsite->save();

        $campsite->tags()->attach($request->tags);

        return $campsite;

    }
    
    public function edit($id)
    {
        $campsite = Campsite::find($id);

        $tags = $campsite->tags->pluck('id');

        return view('update', [
            "campsite" => $campsite,
            "tags" => $tags
        ]);

    }

    public function update($id, Request $request)
    {

        $this->validateCamping();

        $campsite = Campsite::find($id);

        $campsite->name = $request->name;
        $campsite->country = $request->country;
        $campsite->city = $request->city;
        $campsite->website = $request->website;
        $campsite->rating = $request->rating;
        $campsite->save();

        $tags = $campsite->tags->pluck('id');

        $campsite->tags()->detach($tags);

        $campsite->tags()->attach($request->tags);

        return response()->json(["updated" => 'successfuly updated'], 200);

    }

    public function validateCamping() {

        return request()->validate([
            'name' => 'required',
            'country' => 'required|max:50',
            'city' => 'required|max:50',
            'website' => 'required|max:255',
            'rating' => 'required|max:5'
        ]);
    }

}
