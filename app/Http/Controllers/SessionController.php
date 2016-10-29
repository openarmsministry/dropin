<?php

namespace App\Http\Controllers;

use App\Guest;
use App\OpenarmsSession;
use App\Service;
use App\Support\FormInputToModelHelper;
use Illuminate\Http\Request;

use App\Http\Requests;

class SessionController extends Controller
{
    function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sessions = OpenarmsSession::with(['attendances', 'attendances.services'])->whereNotNull('end_timestamp')->paginate(10);

        return view('sessions.index', compact('sessions'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = OpenarmsSession::find($id);
        $guests = $session->attendances->pluck('guest');
        $clothingService = Service::where('short_name', 'clothing')->first();
        $oamIdService = Service::where('short_name', 'oam id')->first();
        $needsClothing = $clothingService->getRequestedAttendances($session);
        $needsOamId = $oamIdService->getRequestedAttendances($session);

        return view('sessions.view', compact('guests', 'session', 'needsClothing', 'needsOamId'));
    }

}
