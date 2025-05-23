<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class InscripcionesController extends Controller
{

    public function CRUDindex()
    {
        return view('CRUD-inscripciones');
    }
}
