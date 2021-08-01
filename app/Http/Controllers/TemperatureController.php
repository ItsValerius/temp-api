<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use App\Jobs\ProcessCSV;
use Illuminate\Http\File;
use Illuminate\Support\Facades\Storage;

class TemperatureController extends Controller
{
    /**
     * Display a listing of unique names.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $names = Log::select("name")->distinct()->get();
        return response($names->toJson());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //

        $files = $request->file("files");
        $names = $request->input("names");

        for ($i = 0; $i < count($files); $i++) {
            $filepath = $files[$i]->getRealPath();
            $path = Storage::putFile('log', new File($filepath));
            ProcessCSV::dispatch($path, $names[$i]);
        }
        return response("Files Uploaded", 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        return response(Log::select("temperature", "timestamp")->where("name", $request->input("name"))->orderby("timestamp")->get()->toJson());
    }

    /**
     * Display all the resources.
     *
     *
     * @return \Illuminate\Http\Response
     */
    public function showAll()
    {
        return response(Log::all()->sortBy("timestamp")->groupBy("name")->toJson());
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
