<?php

namespace App\Http\Controllers;


use App\Http\Requests\Event\StoreRequest as EventStoreRequest;
use App\Models\Event;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class EventController extends Controller
{
   
    public function index(Request $request)
    {
        return Event::all();
    }

    public function store(EventStoreRequest $request)
    {
        return Event::create($request->validated());
    }

    public function update(Event $event) {

    }
    
}
