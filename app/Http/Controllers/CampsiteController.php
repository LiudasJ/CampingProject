<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campsite;
use App\Models\Review;

class CampsiteController extends Controller
{
    
    public function initialize () {
        
        $camping = new Campsite();

        $latestCampings = $camping->latestCampsites();
        $topRatedCampings = $camping->bestRatedCampsites();
        
        $response = [
            'latestcampings' => $latestCampings,
            'topRated' => $topRatedCampings];

        return $response;

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

        $tags = $campsite->tags;

        $response = ['campsite' => $campsite, 'tags' => $tags];

        return $response; 
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

        return $campsite;

    }

    public function delete($id)
    {
        $campsite = Campsite::find($id);
        $campsite->delete();
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
