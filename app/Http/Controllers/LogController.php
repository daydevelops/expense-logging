<?php

namespace App\Http\Controllers;

use App\Category;
use App\Log;
use App\User;
use Illuminate\Http\Request;

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

        return view('logs',compact('logs','refunds'));
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
}
