<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Invitación a Evento</title>
</head>
<body style="font-family: Arial, sans-serif; background-color: #121212; color: #e0e0e0; padding: 20px;">

    <div style="max-width: 600px; margin: auto; background-color: #1e1e1e; border-radius: 12px; box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3); padding: 30px;">
        <div style="text-align: center; margin-bottom: 24px;">
            <h1 style="margin: 0; font-size: 28px; background: linear-gradient(135deg, #a855f7, #ec4899); -webkit-background-clip: text; -webkit-text-fill-color: transparent;">Eventify</h1>
            <p style="color: #aaaaaa; font-size: 14px;">Organiza y descubre eventos increíbles</p>
        </div>

        <h2 style="color: #f472b6;">¡Hola!</h2>

        <p style="font-size: 16px; color: white; ">Has sido invitado al evento <strong style="color: #d946ef;">{{ $evento->nombre }}</strong>.</p>

        <p style= "color: white;" ><strong>Lugar:</strong> {{ $evento->lugar_nombre ?? 'Por definir' }}</p>
        <p style= "color: white;" ><strong>Fecha:</strong> {{ $evento->fecha_evento }}</p>
        <p style= "color: white;" ><strong>Hora:</strong> {{ $evento->hora_evento }}</p>

        <p style= "color: white;" ><strong>Descripción:</strong></p>
        <p style= "color: white;" >{{ $evento->descripcion }}</p>

        <hr style="border-color: #3d3d3d; margin: 20px 0;">

        <p style="font-size: 14px;">Revisa tus eventos y confirma tu asistencia.</p>
        <p style="font-size: 12px; color: #888;">Este correo fue enviado desde Eventify.</p>
    </div>

</body>
</html>
