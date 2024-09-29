<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Project;
use DB;


class HomeController extends Controller
{
    private $fixed_mail_to_support = "theboss@email.com";
    private $sub_for_support = "uodate to admin";

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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $totalProject = DB::table('projects')->count();
        $deletedProject = DB::table('projects')->whereNotNull('deleted_at')->count();
        $activeProject = DB::table('projects')->where('status', 1)->whereNull('deleted_at')->count();
        $inactiveProject = DB::table('projects')->where('status', 2)->whereNull('deleted_at')->count();
        $holdProject = DB::table('projects')->where('status', 3)->whereNull('deleted_at')->count();
        

        // dd( Auth::user()->name );
        
        return view('home',compact('totalProject','deletedProject','activeProject','inactiveProject','holdProject'));
    }

    function test()
    {
        return view('emailTemplate');        
    }

}
