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

        $camping = Campsite::with(['tags', 'images'])->find($id);
        return view('more', [
            "camping" => $camping
        ]);
    }

    public function rate($id, Request $request) {

        $request->validate([
            'rating' => 'required'
        ]);

        $review = new Review();
        $review->store($id, $request->rating);
        
        return response(['result' => 'Successfuly submitted'], 200);

    }
}
