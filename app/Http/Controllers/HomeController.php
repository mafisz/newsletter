<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Campaign;
use App\Member;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $campaigns = Campaign::orderBy('title', 'asc')->get();
        $members = Member::where('active', true)->get();

        $jobs = \DB::select('select * from jobs');

        return view('home', compact('campaigns', 'members', 'jobs'));
    }
}
