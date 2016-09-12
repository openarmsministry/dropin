<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/admin', 'AdminController@index')->middleware('admin');

Route::get('/admin/current', 'AdminController@current')->middleware('admin');

Route::resource('guests', 'GuestController');

Route::put('guests/{id}/photo/rotate', 'GuestController@rotatePhoto')->middleware('auth');

Route::get('/checkin', 'GuestController@checkin');

Route::post('/sessions', function () {
    $user = Auth::user();

    if ($user->cannot('create', \App\OpenarmsSession::class)) {
        abort('403');
    }

    $session = \App\OpenarmsSession::getStarted()->first();

    if ($session) {
        return redirect()->back()->with(['info' => 'There is already a Session']);
    }

    $session = new \App\OpenarmsSession();
    $session->start($user);

    return redirect()->back()->with(['success' => 'Session Started.']);
})->middleware('auth');

Route::post('/sessions/{sessionId}/end', function ($sessionId) {
    $session = \App\OpenarmsSession::find($sessionId);
    $user = Auth::user();
    $session->end($user);
    return redirect('admin')->with(['success' => 'The session has ended']);
})->name('endSession')->middleware('auth');

Route::post('/sessions/{sessionId}/checkin/{guestId}', function ($sessionId, $guestId, \Illuminate\Http\Request $request) {
    $guest = \App\Guest::find($guestId);
    $user = \Auth::user();
    if ($user->cannot('checkin', $guest)) {
        abort('403');
    }

    if (\App\Attendance::where(['openarms_session_id' => $sessionId, 'guest_id' => $guestId])->exists()) {
        return redirect('checkin')->with(['info' => "{$guest->nick_name} is already checked in."]);
    }

    $attendance = new \App\Attendance();
    $attendance->openarms_session_id = $sessionId;
    $attendance->guest_id = $guestId;
    $attendance->signin_timestamp = \Carbon\Carbon::now();
    $attendance->save();

    $services = $request->get('services');

    if ($services) {
        $attendance->services()->sync($services);
    }

    return redirect('checkin')->with(['success' => "{$guest->nick_name} is checked in."]);
})->name('attend')->middleware('auth');

