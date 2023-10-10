<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AttendanceController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();
        $last_timestamp = Timestamp::where('user_id', $user->id)->latest('work_date')->first();

        if(is_null($last_timestamp)){
            return view('attendance_null');
        }

        $month = $request->input('month');

        if(is_null($month)){
            $this_year_month = Carbon::today()->format('Y-m');

            $attendance_items = Timestamp::where('user_id', $user->id)->where('work_date', 'LIKE', '%' . $this_year_month . '%')->paginate(5, ['*'], 'timestamp_history');

            return view('attendance', compact('attendance_items'));
        }

        $attendance_items = Timestamp::where('user_id', $user->id)->where('work_date', 'LIKE', '%'.$month.'%')->paginate(5, ['*'], 'timestamp_history')->appends(['month' => $month]);

        return view('attendance', compact('attendance_items'));

    }

}
