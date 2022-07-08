<?php
    if (!isset($user)) {
        $user['name'] = '';
        $user['email'] = '';
    }
?>

<!doctype html>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <div class="border border-primary d-grid gap-2 col-10 m-3">
            <h1>Cadastro de Usuários</h1>
            <form class="row g-3" method="POST" action="/create/user">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" required class="form-control" placeholder="Nome do aluno" value="{{ $user['name'] }}">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" required id="email" name="email" placeholder="E-mail" value="{{ $user['email'] }}">
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" required id="password" name="password" placeholder="Senha">
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Confirmar senha</label>
                    <input type="passwordConfirme" class="form-control"  required id="passwordConfirme" name="passwordConfirme" placeholder="Confirmar senha">
                </div>
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
            </form> 
        </div>
        <div class="col-12 m-3">
            <button class="btn btn-danger" id="back">Voltar</button>
        </div> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script>
        document.getElementById('back').addEventListener('click', function () {
            window.location.href = '/home';
        });
    </script>
  
        @if (isset($status))
            <div class="p-5">
                @if ($status == 'success')
                    <div class="alert alert-success" role="alert">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-danger" role="alert">
                        {{ $message }}
                    </div>
                @endif
            </div>
        @endif
   
</html>