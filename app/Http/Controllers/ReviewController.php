<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Campsite;

class ReviewController extends Controller
{
    public function getReview ($id) {
        $reviews = Review::where('campsite_id', $id)->get();
        return $reviews;
    }
}
