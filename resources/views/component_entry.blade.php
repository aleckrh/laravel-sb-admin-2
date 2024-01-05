@extends('layouts.admin')
@section('main-content')

<link rel="stylesheet" href="{{ asset('resources/css/sb-admin-2.css') }}">
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ingresar componentes</title>
    <link rel="stylesheet" href="{{ asset('css/sb-admin-2.css') }}">
</head>
<body>
    <form style="text-align: center;">
        <label for="numero_op">Numero OP:</label><br>
        <input type="text" id="numero_up" name="numero_up"><br>
        <label for="familia_componentes">Familia de Componentes:</label><br>
        <select id="familia_componentes" name="familia_componentes" style="margin: 5 auto;">
            <option value="">Seleccionar..</option>
            <!-- Add options here -->
        </select><br>
        <input type="submit" value="Ingresar" style="margin: 10px auto;">
    </form>
    
</body>
</html>

@endsection