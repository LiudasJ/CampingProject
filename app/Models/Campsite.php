<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Review;
use App\Models\Tags;

class Campsite extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'country', 'city', 'website', 'review', 'rating', 'img_path'
    ];

    use HasFactory;

    public function review() {
        return $this->hasMany(Review::class);
    }

    public function tags() {
        return $this->belongsToMany(Tags::class);
    }

    public function latestCampsites() {

        return $this::with(['tags'])->withCount(['review as average_review' => function($query) {
            $query->select(Review::raw('coalesce(avg(review),0)'));
        }])->latest()->paginate(5);

        // return $this::with(['tags'])->latest()->paginate(5);

    }

    public function bestRatedCampsites() {

        return $this::with(['tags'])->withCount(['review as average_review' => function($query) {
            $query->select(Review::raw('coalesce(avg(review),0)'));
        }])->orderByDesc('average_review')->get();

    }

}
