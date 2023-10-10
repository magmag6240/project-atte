<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Timestamp;
use App\Models\Rest;
use Carbon\Carbon;

class TimestampController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $last_timestamp = Timestamp::where('user_id', $user->id)->latest('work_date')->first();
        $today = Carbon::today()->format('Y-m-d');
        $last_start_work = optional($last_timestamp)->start_work_time;
        $last_end_work = optional($last_timestamp)->end_work_time;

        if ((is_null($last_timestamp)) || ((!is_null($last_timestamp)) && ((($last_timestamp->work_date) != $today)))) {
            return view('zero_start');
        }

        if (((!is_null($last_start_work)) && (is_null($last_end_work)))) {
            return view('start_end_start_rest');
        }

        if ((!is_null($last_timestamp)) && (($last_timestamp->work_date) == $today)) {
            return view('end_zero');
        }
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $last_timestamp = Timestamp::where('user_id', $user->id)->latest('work_date')->first();
        $today = Carbon::today()->format('Y-m-d');

        if (is_null($last_timestamp) || (!is_null($last_timestamp)) && (($last_timestamp->work_date) != $today)) {
            $timestamp = Timestamp::create([
                'user_id' => $user->id,
                'work_date_year_month' => Carbon::today()->format('Y-m'),
                'work_date' => Carbon::today(),
                'start_work_time' => Carbon::now(),
            ]);

            return view('start_end_start_rest');
        }

    }
    public function update(Request $request)
    {
        $user = $request->user();

        $timestamp = Timestamp::where('user_id', $user->id)->latest('work_date')->first();
        $last_start_work = $timestamp->start_work_time;
        $last_end_work = $timestamp->end_work_time;

        if ((!is_null($last_start_work)) && (is_null($last_end_work))) {
            $timestamp->update([
                'end_work_time' => Carbon::now(),
            ]);

            $new_timestamp = Timestamp::where('user_id', $user->id)->latest('work_date')->first();
            $new_start_work = $new_timestamp->start_work_time;
            $new_end_work = $new_timestamp->end_work_time;

            $new_start_work_time = new Carbon($new_start_work);
            $new_end_work_time = new Carbon($new_end_work);
            $total_work_time_diff_seconds = $new_start_work_time->diffInSeconds($new_end_work_time);

            $latest_timestamp_id = Timestamp::where('user_id', $user->id)->latest('work_date')->first()->id;
            $diff_rest_time = Rest::where('timestamp_id', $latest_timestamp_id)->pluck('diff_rest_time_seconds');
            $total_rest_time_seconds = $diff_rest_time->sum();

            $total_rest_time_second = new Carbon($total_rest_time_seconds);
            $total_work_time_diff_seconds = new Carbon($total_work_time_diff_seconds);

            $total_work_time_second = $total_work_time_diff_seconds->diffInSeconds($total_rest_time_second);
            
            $total_rest_hours = floor($total_rest_time_seconds / 3600);
            $total_rest_minutes = floor(($total_rest_time_seconds % 3600) / 60);
            $total_rest_seconds = $total_rest_time_seconds % 60;

            $total_rest_time = Carbon::createFromTime($total_rest_hours, $total_rest_minutes, $total_rest_seconds);

            $total_work_time_hours = floor($total_work_time_second / 3600);
            $total_work_time_minutes = floor(($total_work_time_second % 3600) / 60);
            $total_work_time_seconds = $total_work_time_second % 60;

            $total_work_time = Carbon::createFromTime($total_work_time_hours, $total_work_time_minutes, $total_work_time_seconds);

            $timestamp->update([
                'total_work_time' => $total_work_time,
                'total_rest_time' => $total_rest_time,

            ]);

            return view('end_zero');
        
        }
    }
}