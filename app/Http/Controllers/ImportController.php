<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campsite;
use App\Jobs\CampingsCsvProcess;

class ImportController extends Controller
{
    public function import (Request $request) {

        $data = file($request->file);
        $chunks = array_chunk($data, 100);

        foreach ($chunks as $key => $chunk) {
            $name = "/tmp{$key}.csv";
            $path = resource_path("temp");
            file_put_contents($path . $name, $chunk);
        }

        $path = resource_path("temp");
        $files = glob("$path/*.csv");
        
        $header = [];

        foreach ($files as $key => $file) {

            $data = array_map('str_getcsv', file($file));

            if ($key === 0) {
                $header = $data[0];
                unset($data[0]);
            }
            
            CampingsCsvProcess::dispatch($data, $header);

            unlink($file);

        }

    }

}
