<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Estilos -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Fuentes -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
        }
        .auth-background {
            min-height: 100vh;
            background: linear-gradient(135deg, #7c3aed, #db2777);
        }
        .form-box {
            background-color: #1e1e1e;
            color: #fff;
            border-radius: 1rem;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.3);
        }
    </style>
</head>
<body>
    <div class="auth-background flex items-center justify-center p-4">
        <div class="form-box w-full max-w-md">
            {{ $slot }}
        </div>
    </div>
</body>
</html>

