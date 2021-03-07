<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campsite;
use App\Models\Tags;

class TagsController extends Controller
{
    //
    public function getTags($id) {
        $campsite = Campsite::find($id);
        return $campsite->tags->pluck('name');
    }

    public function tags () {

        $tags = Tags::all();
        return $tags;
    }
}
