<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invitacion; 
use App\Models\User;

class CorreoController extends Controller
{
    public function enviar()
    {
        //$empleados = User::where('rol', 'empleado')->get();
        $pedidos = Pedido::all();
        
        //foreach ($empleados as $empleado) {
           // Mail::to($empleado->email)->send(new Reporte($pedidos));
        //}
        $destinatario = 'antoniovarelatristan@gmail.com';
        Mail::to($destinatario)->send(new Reporte($pedidos));
        return redirect()->back();


    }
}
