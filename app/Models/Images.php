<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Campsite;

class Images extends Model
{
    protected $guarded = [];
    
    public function campsite () 
    {
        return $this->belongsTo(Campsite::class);
    }

    public function store ($images, $campingId) {

        foreach ($images as $image) {
            $input['campsite_id'] = $campingId;
            $input['img_path'] = $image;
            Images::create($input);
        }
    }

    public function oneImgStore ($image, $campingId) {

        $input['campsite_id'] = $campingId;
        $input['img_path'] = $image;
        Images::create($input);

    }
}
