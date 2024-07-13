<?php

namespace App\Http\Controllers;


use App\Http\Requests\Event\StoreRequest as EventStoreRequest;
use App\Http\Requests\Event\UpdateRequest as EventUpdateRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventController extends Controller
{
   
    public function index(Request $request)
    {
        return Event::paginate(6);
    }

    public function store(EventStoreRequest $request)
    {
        return Event::create($request->validated());
    }

    public function destroy(Event $event)
    {
        return $event->delete();
    }

    public function update(Event $event, EventUpdateRequest $request) {
        return $event->update($request->validated());
    }
    
}
