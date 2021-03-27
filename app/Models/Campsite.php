<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

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
        'name'
    ];

    use HasFactory;

    public function reviews() 
    {
        return $this->hasMany(Review::class);
    }

    public function avgReview() 
    {
        return $this->reviews()->avg('review');
    }

    public function tags() 
    {
        return $this->belongsToMany(Tags::class);
    }

    public function latestCampsites() 
    {

        return $this::with(['tags'])
                ->withCount(['reviews as average_review' => function($query) {
                    $query->select(Review::raw('coalesce(avg(review),0)'));
                }])
                ->latest()
                ->take(5)
                ->get();
    }

    public function bestRatedCampsites() 
    {

        return $this::with(['tags'])
                ->withCount(['reviews as average_review' => function($query) {
                                $query->select(Review::raw('coalesce(avg(review),0)'));
                            }])
                ->orderByDesc('average_review')
                ->take(5)
                ->get();

    }

    public function allCamps() 
    {
        return $this::with(['tags'])
                ->withCount(['reviews as average_review' => function($query) {
                    $query->select(Review::raw('coalesce(avg(review),0)'));
                }])
                ->orderBy('rating', 'desc')
                ->get();
    }

}
