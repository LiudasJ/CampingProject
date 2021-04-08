<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Campsite;
use App\Jobs\CampingsCsvProcess;

class ImportController extends Controller
{
    public function import (Request $request) 
    {

        $request->validate([
            'file' => 'required|mimes:csv'
        ]);

        $file = file($request->file->getRealPath());

        $data = array_slice($file, 1);

        $chunks = array_chunk($data, 100);

        foreach ($chunks as $key => $chunk) {
            $fileName = resource_path("temp/file$key.csv");
            file_put_contents($fileName, $chunk);
        }

        $path = resource_path('temp\*.csv');
        $allFiles = glob($path);

        foreach ($allFiles as $file) {
            CampingsCsvProcess::dispatch($file);
        }

        return response()->json(['status' => 'imported']);

    }

    public function export () 
    {

        $campings = Campsite::all();

        $fileName = 'campings.csv';

        $headers = array(
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        );
        
        $columns = array(
            'name', 
            'country', 
            'city', 
            'website', 
            'rating', 
            'image'
        );

        $callback = function() use($campings, $columns) {

            $file = fopen('php://output', 'w');

            fputcsv($file, $columns);

            foreach ($campings as $camping) {
                $row['name']  = $camping->name;
                $row['country']    = $camping->country;
                $row['city']    = $camping->city;
                $row['website']  = $camping->website;
                $row['rating']  = $camping->rating;
                $row['image']  = $camping->img_path;

                fputcsv($file, array($row['name'], $row['country'], $row['city'], $row['website'], $row['rating'], $row['image']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);

    }
}
