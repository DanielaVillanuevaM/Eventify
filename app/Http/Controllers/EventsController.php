<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class EventsController extends Controller
{
    public function CRUDindex()
    {

        return view('CRUD-events');
    }
}
