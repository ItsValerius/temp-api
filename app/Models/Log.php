<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Log extends Model
{
    use HasFactory;

    protected $table="logs";
    public $timestamps = false;

    protected $fillable = [
        'name',
        'timestamp',
        'temperature',
    ];


    // public function saveLog($temp,$time,$name){
    //     $log = new Log();
    //     $log->name = $name;
    //     $log->temperature = $temp;
    //     $log->timestamp = $time;
    //     $log->save();
    //  }
}
