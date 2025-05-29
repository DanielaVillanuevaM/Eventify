<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Mail;
use App\Mail\Invitacion; 
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

    function misEventos()
    {
        $user = Auth::user();

    // Unimos eventos con solicitudes, filtrando solo las del usuario actual
    $eventos = DB::table('solicitudes')
        ->join('eventos', 'solicitudes.evento_id', '=', 'eventos.id')
        ->join('lugars', 'eventos.lugar_id', '=', 'lugars.id')
        ->where('solicitudes.usuario_id', $user->id)
        ->select(
            'eventos.*',
            'solicitudes.estado as estado_solicitud',
            'lugars.nombre as lugar_nombre',
            'lugars.direccion as lugar_direccion'
        )
        ->get();

        $lugares = Lugar::all();
        $usuarios = User::all();

    return view('miseventos', compact('eventos', 'lugares', 'usuarios'));
}

     function misProyectos()
    {
        $user = Auth::user();

    if (!$user || !in_array($user->rol, ['Administrador', 'Organizador'])) {
        abort(403, 'Acceso no autorizado');
    }

    // Obtener solo los eventos creados por el usuario autenticado
    $eventos = Evento::where('user_id', $user->id)->get();

    $lugares = Lugar::all();
    $usuarios = User::all();

    return view('administrador.misproyectos', compact('eventos', 'lugares', 'usuarios'));
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

     public function crudEventosp()
{
    $user = Auth::user();

    $query = DB::table('eventos')
        ->join('lugars', 'eventos.lugar_id', '=', 'lugars.id')
        ->select('eventos.*', 'lugars.nombre as lugar_nombre');

    if ($user) {
        // Eventos en los que ya solicitó asistencia
        $eventosSolicitados = DB::table('solicitudes')
            ->where('usuario_id', $user->id)
            ->pluck('evento_id');

        // Excluir eventos que ya solicitó y los que él mismo creó
        $query->whereNotIn('eventos.id', $eventosSolicitados)
              ->where('eventos.user_id', '!=', $user->id);

        if ($user->rol !== 'Administrador')  {
            $query->where('eventos.estado', 'publico');
        }
    } else {
        // Usuario no autenticado → mostrar solo públicos
        $query->where('eventos.estado', 'publico');
    }

    $eventos = $query->get();
    $usuarios = User::all(['id', 'name', 'email']);
    $lugares = Lugar::all();

    return view('administrador.eventosprueba', compact('eventos', 'lugares', 'usuarios'));
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
        $evento->user_id = $request->user_id;
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
        ->join('users', 'eventos.user_id', '=', 'users.id')
        ->select(
            'eventos.*',
            'lugars.nombre as lugar_nombre',
            'lugars.direccion as lugar_direccion',
            'lugars.descripcion as lugar_descripcion',
            'users.name as nombre_usuario'
        )
        ->where('eventos.id', $id)
        ->first();

  
    if (!$evento) {
        abort(404);
    }

  
    $usuariosNoInvitados = User::whereNotIn('id', function ($query) use ($id) {
        $query->select('usuario_id')
            ->from('solicitudes')
            ->where('evento_id', $id);
    })
    ->where('id', '!=', $evento->user_id) 
    ->get();

    $usuariosInvitados = DB::table('solicitudes')
    ->join('users', 'solicitudes.usuario_id', '=', 'users.id')
    ->where('solicitudes.evento_id', $id)
    ->select('solicitudes.id as solicitud_id', 'users.id', 'users.name', 'users.email', 'solicitudes.estado')
    ->get();


   
    return view('administrador.evento_detalles', compact('evento', 'usuariosNoInvitados', 'usuariosInvitados'));
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

    public function asistir($eventoId)
    {
        $user = Auth::user();

     
        $existe = Solicitude::where('usuario_id', $user->id)
            ->where('evento_id', $eventoId)
            ->exists();

        if ($existe) {
            return redirect()->back()->with('mensaje', 'Ya te has registrado para este evento.');
        }

   
        Solicitude::create([
            'usuario_id' => $user->id,
            'evento_id' => $eventoId,
            'estado' => 'solicitado',
        ]);

        return redirect()->back()->with('mensaje', 'Te has registrado correctamente.');
    }


    public function aceptar($eventoId): RedirectResponse
{
    $userId = Auth::id();

    $solicitud = Solicitude::where('evento_id', $eventoId)
        ->where('usuario_id', $userId)
        ->first();

    if ($solicitud) {
        $solicitud->estado = 'aceptada';
        $solicitud->save();
        return back()->with('success', 'Solicitud aceptada correctamente.');
    }

    return back()->with('error', 'Solicitud no encontrada.');
}

public function rechazar($eventoId): RedirectResponse
{
    $userId = Auth::id();

    $solicitud = Solicitude::where('evento_id', $eventoId)
        ->where('usuario_id', $userId)
        ->first();

    if ($solicitud) {
        $solicitud->estado = 'rechazada';
        $solicitud->save();
        return back()->with('success', 'Solicitud rechazada correctamente.');
    }

    return back()->with('error', 'Solicitud no encontrada.');
}


public function agregarInvitacion(Request $request)
{
    $request->validate([
        'evento_id' => 'required|exists:eventos,id',
        'usuario_id' => 'required|exists:users,id',
    ]);

    $existe = DB::table('solicitudes')
        ->where('evento_id', $request->evento_id)
        ->where('usuario_id', $request->usuario_id)
        ->exists();

    if ($existe) {
        return back()->with('error', 'El usuario ya fue invitado.');
    }

    DB::table('solicitudes')->insert([
        'evento_id' => $request->evento_id,
        'usuario_id' => $request->usuario_id,
        'estado' => 'pendiente',
        'created_at' => now(),
        'updated_at' => now(),
    ]);

    
    $usuario = DB::table('users')->where('id', $request->usuario_id)->first();

    $evento = DB::table('eventos')
    ->join('lugars', 'eventos.lugar_id', '=', 'lugars.id')
    ->join('users', 'eventos.user_id', '=', 'users.id')
    ->where('eventos.id', $request->evento_id)
    ->select(
        'eventos.*',
        'lugars.nombre as lugar_nombre',
        'users.name as nombre_creador',
        'users.email as email_creador'
    )
    ->first();

    Mail::to($usuario->email)->send(new Invitacion($evento));

    return back()->with('success', 'Usuario invitado exitosamente.');
}


 
public function eliminarSolicitud($usuario_id, $evento_id)
{
    DB::table('solicitudes')
        ->where('usuario_id', $usuario_id)
        ->where('evento_id', $evento_id)
        ->delete();

    return back()->with('success', 'Invitación eliminada correctamente.');
}

public function descargarInvitadosPDF($id)
{
    $invitados = DB::table('solicitudes')
        ->join('users', 'solicitudes.usuario_id', '=', 'users.id')
        ->where('solicitudes.evento_id', $id)
        ->where('solicitudes.estado', 'aceptada') 
        ->select('users.name', 'users.email', 'solicitudes.estado')
        ->get();

    $evento = DB::table('eventos')->where('id', $id)->first();

    $pdf = Pdf::loadView('pdf.lista_invitados', compact('invitados', 'evento'));

    return $pdf->download('lista_invitados_evento_' . $id . '.pdf');
}


public function editarEstado(Request $request, $id)
{
    $request->validate([
        'estado' => 'required|in:pendiente,aceptada,rechazada',
        'usuario_id' => 'required|exists:users,id',
        'evento_id' => 'required|exists:eventos,id',
    ]);

    $solicitud = DB::table('solicitudes')
        ->where('usuario_id', $request->usuario_id)
        ->where('evento_id', $request->evento_id)
        ->first();

    if (!$solicitud) {
        return response()->json(['error' => 'Solicitud no encontrada.'], 404);
    }

    DB::table('solicitudes')
    ->where('usuario_id', $id) 
    ->where('evento_id', $request->evento_id)
    ->update(['estado' => $request->estado]);

     return back()->with('success', 'Solicitud guardada correctamente.');
}

}
