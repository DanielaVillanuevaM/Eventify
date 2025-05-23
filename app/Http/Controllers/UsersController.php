<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function CRUDindex()
    {
        return view('CRUD-users');
    }
}
