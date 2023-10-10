<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Rest;
use App\Models\Timestamp;
use Carbon\Carbon;

class RestController extends Controller
{
    public function store(Request $request)
    {
        $user = $request->user();
        $timestamp = Timestamp::where('user_id', $user->id)->latest('work_date')->first();

        $timestamp_rest = Rest::create([
            'timestamp_id' => $timestamp->id,
            'start_rest_time' => Carbon::now(),
        ]);

        return view('start_end_end_rest');

    }
    public function update(Request $request)
    {
        $user = $request->user();
        $timestamp_id = Timestamp::where('user_id', $user->id)->latest('work_date')->first()->id;
        $timestamp_rest = Rest::where('timestamp_id', $timestamp_id)->latest()->first();
        $last_start_rest = $timestamp_rest->start_rest_time;
        $last_end_rest = $timestamp_rest->end_rest_time;

        if ((!is_null($last_start_rest)) && (is_null($last_end_rest))) {
            $timestamp_rest->update([
                'end_rest_time' => Carbon::now(),
            ]);

            $new_time_stamp_rest = Rest::where('timestamp_id', $timestamp_id)->latest()->first();
            $new_start_rest = $new_time_stamp_rest->start_rest_time;
            $new_end_rest = $new_time_stamp_rest->end_rest_time;

            $new_start_rest_time = new Carbon($new_start_rest);
            $new_end_rest_time = new Carbon($new_end_rest);
            $timestamp_rest->update([
                'diff_rest_time_seconds' => $new_start_rest_time->diffInSeconds($new_end_rest_time),

            ]);

            return view('start_end_start_rest');

        }
        
    }
}
