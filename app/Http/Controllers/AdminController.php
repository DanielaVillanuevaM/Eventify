<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Lugar;
use App\Models\Evento;
use App\Models\User;
use App\Models\Solicitude;

use Illuminate\Http\Request;

class AdminController extends Controller
{
    function crudLugares()
    {
        $lugares = Lugar::all();
        return view('administrador.lugares', compact('lugares'));
    }

    function guardarLugar(Request $request)
    {
        $lugar = new Lugar();
        $lugar->nombre = $request->nombre;
        $lugar->descripcion = $request->descripcion;
        $lugar->direccion = $request->direccion;
        $lugar->capacidad = $request->capacidad;
        $lugar->save();
        return redirect()->back();
    }

    function eliminarLugar($id)
    {
        $lugar = Lugar::find($id);
        $lugar->delete();
        return redirect()->back();
    }

    function actualizarLugar(Request $request, $id)
    {
        $lugar = Lugar::find($id);
        $lugar->nombre = $request->nombre;
        $lugar->descripcion = $request->descripcion;
        $lugar->direccion = $request->direccion;
        $lugar->capacidad = $request->capacidad;
        $lugar->save();
        return redirect()->back();
    }

        function crudEventosp()
    {
        $eventos = DB::table('eventos')
        ->join('lugars', 'eventos.lugar_id', '=', 'lugars.id')
        ->select('eventos.*', 'lugars.nombre as lugar_nombre')
        ->get();

    
    $usuarios = User::all(['id', 'name', 'email']);
    $lugares = Lugar::all();

    return view('administrador.eventosprueba', compact('eventos', 'lugares','usuarios'));
    }

    function guardarEvento(Request $request)
    {
        $evento = new Evento();
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->lugar_id = $request->lugar;
        $evento->fecha_evento = $request->fecha;
        $evento->hora_evento = $request->hora;
        $evento->estado = $request->estado;
        $evento->organizador = $request->organizador;
        $evento->save();
        return redirect()->back();
    }

    function eliminarEvento($id)
    {
        $evento = Evento::find($id);
        $evento->delete();
        return redirect()->back();
    }

    function eliminarUsuario($id)
    {
        $user = User::find($id);
        $user->delete();
        return redirect()->back();
    }

    function actualizarEvento(Request $request, $id)
    {
        $evento = Evento::find($id);
        $evento->nombre = $request->nombre;
        $evento->descripcion = $request->descripcion;
        $evento->fecha_evento = $request->fecha;
        $evento->hora_evento = $request->hora;
        $evento->estado = $request->estado;
        $evento->lugar_id = $request->lugar;
        $evento->save();
        return redirect()->back();
    }

    public function mostrarDetalles($id)
{
    $evento = DB::table('eventos')
    ->join('lugars', 'eventos.lugar_id', '=', 'lugars.id')
    ->select(
        'eventos.*',
        'lugars.nombre as lugar_nombre',
        'lugars.direccion as lugar_direccion',
        'lugars.descripcion as lugar_descripcion'
    )
    ->where('eventos.id', $id)
    ->first();


    if (!$evento) {
        abort(404);
    }

    return view('administrador.evento_detalles', compact('evento'));
}


    function crudUsuarios()
{
    $usuarios = User::where('id', '!=', 1)->get(); // excluye ID 1
    return view('administrador.usuarios', compact('usuarios'));
}



    public function enviarInvitaciones(Request $request)
{
    $request->validate([
        'evento_id' => 'required|exists:eventos,id',
        'usuarios' => 'required|array',
        'usuarios.*' => 'exists:users,id',
    ]);

    foreach ($request->usuarios as $userId) {
        DB::table('solicitudes')->updateOrInsert([
            'evento_id' => $request->evento_id,
            'usuario_id' => $userId
        ], [
            'estado' => 'pendiente',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    return response()->json(['message' => 'Invitaciones enviadas']);
}

public function obtenerUsuariosNoInvitados($eventoId)
{
    
    $usuariosInvitados = DB::table('solicitudes')
        ->where('evento_id', $eventoId)
        ->pluck('user_id');

    $usuariosDisponibles = DB::table('users')
        ->whereNotIn('id', $usuariosInvitados)
        ->get();

    
    return response()->json($usuariosDisponibles);
}

public function usuariosDisponibles($eventoId)
{
    $evento = Evento::findOrFail($eventoId);

    $usuariosYaInvitados = Solicitude::where('evento_id', $eventoId)->pluck('usuario_id');
    $usuariosDisponibles = User::whereNotIn('id', $usuariosYaInvitados)->get(['id', 'name']);

    return response()->json($usuariosDisponibles);
}


public function actualizarUsuario(Request $request, $id)
{
    $request->validate([
        'rol' => 'required|in:Administrador,Organizador,Invitado',
    ]);

    $usuario = User::findOrFail($id);
    $usuario->rol = $request->input('rol');
    $usuario->save();

    return redirect()->back()->with('success', 'Rol actualizado correctamente.');
}


}
