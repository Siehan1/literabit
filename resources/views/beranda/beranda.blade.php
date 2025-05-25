<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda | LittleRabbit</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
</head>
<body>
    <x-utama.navside></x-utama.navside>
    {{$users}}<br>
    <form action="{{ route('logout') }}" method="POST">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>