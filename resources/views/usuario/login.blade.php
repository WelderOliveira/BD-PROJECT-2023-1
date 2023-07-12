<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <title>Tela de Login</title>
    <style>
        .login-container {
            max-width: 400px;
            margin: 0 auto;
            margin-top: 150px;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #fff;
        }

        .login-container h2 {
            text-align: center;
            margin-bottom: 30px;
        }
    </style>
</head>
<body>

@isset($mensagem)
    <div class="alert alert-success">
        {{$mensagem}}
    </div>
@endisset

<div class="login-container">
    <h2>Login</h2>
    <form action="{{route('auth.usuarios')}}" method="POST">
        @csrf
        <div class="form-group">
            <label for="email">E-mail</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Informe seu e-mail">
        </div>
        <div class="form-group">
            <label for="senha">Senha</label>
            <input type="password" class="form-control" id="senha" name="senha" placeholder="Informe sua senha">
        </div>
        <button type="submit" class="btn btn-primary btn-block">Entrar</button>
    </form>
    <a href="{{route('register.usuario')}}" class="btn btn-secondary btn-block">Cadastrar</a>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</body>
</html>
