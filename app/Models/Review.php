<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campsite;

class Review extends Model
{
    use HasFactory;

    public function campsite() {
        return $this->belongsTo(Campsite::class);
    }

    public function store ($id, $review) {
        
        $this->campsite_id = $id;
        $this->review = $review;
        $this->save();

    }

}
