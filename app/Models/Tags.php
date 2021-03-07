<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campsite;

class Tags extends Model
{
    use HasFactory;

    public function campsites() {
        return $this->belongsToMany(Campsite::class);
    }
    public function tags () {
        return $this->all();
    }
}
