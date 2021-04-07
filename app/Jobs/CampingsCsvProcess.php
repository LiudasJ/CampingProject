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

    public $file;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($csv)
    {
        $this->file = $csv;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data = array_map('str_getcsv', file($this->file));

        foreach ($data as $row) {
            Campsite::updateOrCreate([
                'name' => $row[0]
            ], [
                'country' => $row[1],
                'city' => $row[2],
                'website' => $row[3],
                'rating' => $row[4],
                'img_path' => $row[5]
            ]);
        }
        
        unlink($this->file);
    }
}
