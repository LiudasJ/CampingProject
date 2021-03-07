<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Campsite;

class CampingsCsvProcess implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $header;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($data,$header)
    {
        $this->data = $data;
        $this->header = $header;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {

        foreach($this->data as $camp) {

            $camping = array_combine($this->header, $camp);

            $tempCamp = new Campsite();

            $tempCamp->name = $camp["name"];
            $tempCamp->country = $camp["country"];
            $tempCamp->city = $camp["city"];
            $tempCamp->website = $camp["website"];
            $tempCamp->review = $camp["review"];
            $tempCamp->rating = $camp["rating"];
            $tempCamp->img_path = $camp["img_path"];

            $tempCamp->save();

        }

    }
}
