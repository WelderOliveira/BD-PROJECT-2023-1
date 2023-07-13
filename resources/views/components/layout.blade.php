<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @yield('style')
    @vite(['resources/css/app.scss', 'resources/js/app.js'])
</head>
<body>
@includeIf('components.navbar')
<div class="container mt-3">
    @if(session('mensagem'))
        <div class="alert alert-success" role="alert">
            {{  session('mensagem') }}
        </div>
    @elseif(session('error'))
        <div class="alert alert-danger" role="alert">
            {{session('error')}}
        </div>
    @endif

    {{$slot}}
</div>
</body>
</html>
