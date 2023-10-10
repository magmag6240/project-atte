<?php

namespace App\Http\Controllers;

use App\Models\Timestamp;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->input('keyword');
        $query = User::query();

        if(!empty($keyword))
        {
            $query->where('id', 'LIKE', '%'.$keyword.'%')
            ->orWhere('name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('email', 'LIKE', '%'.$keyword.'%')
            ->orWhere('role', 'LIKE', '%'.$keyword.'%');
        }

        $user_data = $query->paginate(5);

        return view('admin', compact('user_data', 'keyword'));
    }

    public function show(Request $request, $id)
    {     
        $user = User::find($id);
        $last_timestamp = Timestamp::where('user_id', $user->id)->latest('work_date')->first();

        if(is_null($last_timestamp)){
            return view('admin_detail_null');
        }

        $admin_user_details = Timestamp::where('user_id', $user->id)->paginate(5, ['*'], 'timestamp_history');

        return view('admin_detail', compact('admin_user_details'));
        
    }

    public function update(Request $request, $id)
    {
        $user = User::find($id);

        $user->role = $request->input('role');
        $user->save();

        return redirect('/admin');
    }

    public function destroy($id)
    {
        $user = User::find($id)->delete();

        return redirect('/admin');
    }
}
