<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\Log;
use Illuminate\Support\Facades\Storage;

class ProcessCSV implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $filepath;
    protected $name;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($filepath, $name)
    {
        $this->filepath = $filepath;
        $this->name = $name;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $start = microtime(true);

        foreach (array_map('str_getcsv', file(Storage::path($this->filepath))) as $entrie) {
            $data[] =
                [
                    "name" => $this->name,
                    "temperature" => $entrie[0],
                    "timestamp" => $entrie[2],
                ];
        };

        // $chunks = array_chunk($data,2500);
        //   foreach($chunks as $chunk){
        //     Log::insert($chunk);
        // }

        Log::insert($data);

        Storage::delete($this->filepath);
        $time = microtime(true) - $start;
        error_log($time);
    }
}
