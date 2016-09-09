<?php

namespace App\Http\Controllers;

use App\OpenarmsSession;
use App\Service;
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
        $session = OpenarmsSession::getStarted()->with('attendances.guest')->first();

        if (is_null($session)) {
            return view('admin.current', compact('session'));
        }

        $guests = $session->attendances->pluck('guest');
        $clothingService = Service::where('short_name', 'clothing')->first();
        $oamIdService = Service::where('short_name', 'oam id')->first();
        $needsClothing = $clothingService->getRequestedAttendances($session);
        $needsOamId = $oamIdService->getRequestedAttendances($session);

        return view('admin.current', compact('guests', 'session', 'needsClothing', 'needsOamId'));
    }
}
