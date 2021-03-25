<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campsite;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;

class CampsiteController extends Controller
{

    public function all() {

        $camping = new Campsite();

        return view('welcome' , [
            'campings' => $camping->allCamps()
        ]);
    }

    public function latest ()
    {
        
        $camping = new Campsite();

        $latestCampings = $camping->latestCampsites();

        return view('latest', [
            'campings' => $latestCampings
        ]);

    }

    public function topRated() 
    {

        $camping = new Campsite();
        $topRatedCampings = $camping->bestRatedCampsites();

        return view('top', [
            'campings' => $topRatedCampings
        ]);

    }

    public function readMore ($id) {

        $camping = Campsite::with(['tags'])->find($id);
        return view('more', [
            "camping" => $camping
        ]);
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

    public function rate($id, Request $request) {

        $review = new Review();
        $review->store($id, $request->rating);
        
        return response(['result' => 'Successfuly submitted'], 200);

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
