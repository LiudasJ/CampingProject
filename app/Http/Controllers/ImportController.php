<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Campsite;
use App\Jobs\CampingsCsvProcess;

class ImportController extends Controller
{
    public function import (Request $request) {

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

}
