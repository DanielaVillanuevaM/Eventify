<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <title>Lista de invitados</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            background-color: #f9fafb;
            color: #333;
            padding: 40px;
        }

        h2 {
            text-align: center;
            color: #4f46e5;
            margin-bottom: 30px;
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
        }

        th, td {
            padding: 12px 15px;
            text-align: left;
        }

        thead {
            background-color: #4f46e5;
            color: white;
        }

        tbody tr:nth-child(even) {
            background-color: #f3f4f6;
        }

        tbody tr:hover {
            background-color: #e0e7ff;
        }

        td {
            border-top: 1px solid #e5e7eb;
        }

        .estado {
            text-transform: capitalize;
        }
    </style>
</head>
<body>
    <h2>Lista de invitados para el evento: {{ $evento->nombre }}</h2>

    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Email</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invitados as $invitado)
            <tr>
                <td>{{ $invitado->name }}</td>
                <td>{{ $invitado->email }}</td>
                <td class="estado">{{ $invitado->estado }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>

