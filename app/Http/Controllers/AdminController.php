<?php

namespace App\Http\Controllers;

use App\OpenarmsSession;
use Illuminate\Http\Request;

class AdminController extends Controller
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
        $session = OpenarmsSession::getStarted()->first();

        return view('admin.dashboard');
    }

    public function current()
    {
        $session = OpenarmsSession::getStarted()->first();
        $guests = $session->attendances->pluck('guest');
        return view('admin.current', compact('guests', 'session'));
    }
}
