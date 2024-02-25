<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Helpers\CSVProcessor;

class CsvController extends Controller
{   

    public function index()
    {


        $processedData = session()->get('processedData', []);


        return view('uploadAndProcessCSV', compact('processedData'));
    }

    
    public function uploadAndProcess(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|mimes:csv,txt'
        ]);

        $file = $request->file('csv_file');

        $processor = new CSVProcessor($file->getPathname());

      
        $processedData = $processor->process();

        
        $file->storeAs('csv', $file->getClientOriginalName(), 'public'); // we soring files - just in case we need them later

        session()->flash('processedData', $processedData);

        return back()->with('success', 'File uploaded successfully');
    }
}
