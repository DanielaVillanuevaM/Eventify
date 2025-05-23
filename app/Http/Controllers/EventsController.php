<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Event;

class EventsController extends Controller
{
    public function CRUDindex()
    {
        $events = Event::all();
        return view('CRUD-events', compact('events'));
    }
}
