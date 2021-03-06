<?php

namespace App\Http\Controllers;

use App\Category;
use App\Log;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $logs = Log::where(['archived'=>0])->get();
        $refunds = Log::calculateRefunds($logs);
        $keys = array_keys($refunds);
        $difference = abs($refunds[$keys[0]]-$refunds[$keys[1]]);
        if ($refunds[$keys[0]] < $refunds[$keys[1]]) {
            $result = $keys[0] . " owes " . $keys[1] . " " . $difference;
        } else {
            $result = $keys[1] . " owes " . $keys[0] . " " . $difference;
        }

        return view('logs',compact('logs','refunds','result'));
    }

    public function archived() {
        $logs =  Log::where(['archived'=>1])->get();
        return view('logs',compact('logs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::all();
        $categories = Category::all();
        return view('newlog',compact('categories','users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Log::create($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Log  $log
     * @return \Illuminate\Http\Response
     */
    public function destroy(Log $log)
    {
        // no validation needed, anyone can delete a log
        $log->delete();
    }

    public function archive() {
        DB::table('logs')->update(['archived'=>1]);
    }
}
