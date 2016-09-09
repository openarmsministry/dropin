<?php

namespace App\Http\Controllers;

use App\Guest;
use App\Support\FormInputToModelHelper;
use Illuminate\Http\Request;

use App\Http\Requests;

class GuestController extends Controller
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
        $firstName = $request->query('first_name');
        $lastName = $request->query('last_name');
        if ($firstName and $lastName) {
            $guests = Guest::where(['first_name' => $firstName, 'last_name' => $lastName])->get();
        }

        if ($firstName and ! $lastName) {
            $guests = Guest::where('first_name', $firstName)->get();
        }

        if (! $firstName and $lastName) {
            $guests = Guest::where('last_name', $lastName)->get();
        }

        if (! $firstName and ! $lastName) {
            $guests = Guest::all();
        }

        return view('guests.index', compact('guests'));
    }

    public function checkin(Request $request) {
        $session = \App\OpenarmsSession::getStarted()->first();
        $services = \App\Service::all();
        $nickname = title_case($request->query('nickname'));

        $servicesArray = $services->map(function ($service) {
            return ['key' => $service->id, 'value' => $service->short_name];
        });

        $guests = [];

        if ($nickname) {
            $guests = \App\Guest::nicknameCheckin($nickname, $session->id)->get();
        }

        return view('guests.checkin', compact('guests', 'nickname', 'session', 'servicesArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('guests.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $guest = new Guest();
        //TODO validate input

        $formHelper = new FormInputToModelHelper($guest, $request);
        $formHelper->processModel();
        $guest->save();

        if ($request->hasFile('guest_photo')) {
            $photo = $request->file('guest_photo');
            $path = $photo->store('guest-photos', 's3');
            $guest->photo_path = $path;
        }

        $guest->save();
        return redirect()->back()->with(['success' => "Guest {$guest->first_name} is created"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $guest = Guest::with('attendances')->find($id);
        $attendances = $guest->attendances->sortByDesc('signin_timestamp')->values()->all();
        return view('guests.show', compact('guest', 'attendances'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $guest = Guest::find($id);
        return view('guests.edit', compact('guest'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $guest = Guest::find($id);
        \Storage::cloud()->delete($guest->photo_path);
        $guest->delete();
        return redirect('guests');
    }
}
