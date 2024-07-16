<?php

namespace App\Http\Controllers;


use App\Http\Requests\Event\StoreRequest as EventStoreRequest;
use App\Http\Requests\Event\RegisterRequest as EventRegisterRequest;
use App\Http\Requests\Event\UpdateRequest as EventUpdateRequest;
use App\Models\Event;
use App\Models\EventUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EventController extends Controller
{
   
    public function index(Request $request)
    {
        return Event::paginate(8);
    }

    public function store(EventStoreRequest $request)
    {
        return Event::create($request->validated());
    }

    public function destroy(Event $event)
    {
        return $event->delete();
    }

    public function show($slug) 
    {
        return Event::where('slug', $slug)->first();
    }

    public function update(Event $event, EventUpdateRequest $request) {
        return $event->update($request->validated());
    }
    
    public function registerUserEvent(EventRegisterRequest $request)
    {
        $user = User::create([
            'name'  => $request->name,
            'email' => $request->email,
            'password' => Hash::make('user1234'),
        ]);

        $event_user = EventUser::create([
            'event_id' => $request->event_id,
            'user_id'  => $user->id,
        ]);

        Event::where('id', $request->event_id)->increment('total_participant', 1);

        return $event_user;
    }
}
