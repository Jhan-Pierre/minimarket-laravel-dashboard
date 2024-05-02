<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $data['subject'] }}</title>
</head>
<body>
    <h1>Hola {{ $data['name'] }}</h1>
    <p>Gracias por contactarnos, en breve le responderemos.</p>
    <p>Asunto: {{ $data['subject'] }}</p>
    <p>Mensaje: {{ $data['message'] }}</p>
</body>
</html>
