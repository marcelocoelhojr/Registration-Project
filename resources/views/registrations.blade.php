<?php 
    if (!isset($names)) {
        $names['count'] = 0;
    }
?>
<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <div class="d-grid gap-2 col-10 m-3">
            <h1>Inscrições</h1>
            <form class="row g-3" method="POST" action="/create/registration">
                @csrf
                <div class="col-md-6">
                    <label for="name" class="form-label">Nome</label>
                    <input type="text" name="name" id="name" class="form-control" placeholder="Nome do aluno">
                </div>
                <div class="col-md-6">
                    <label for="email" class="form-label">E-mail</label>
                    <input type="email" class="form-control" id="email" name="email" placeholder="E-mail">
                </div>
                <div class="col-6">
                    <label for="cpf" class="form-label">CPF</label>
                    <input type="text" class="form-control" id="cpf" name="cpf" placeholder="CPF">
                </div>
                <div class="col-md-6">
                    <label for="address" class="form-label">Endereço</label>
                    <input type="text" class="form-control" id="address" name="address" placeholder="Endereço">
                </div>
                <div class="col-md-6">
                    <label for="uf" class="form-label">UF</label>
                    <input type="text" class="form-control" id="uf" name="uf" placeholder="UF">
                </div>
                <div class="col-md-6">
                    <label for="company" class="form-label">Empresa</label>
                    <input type="text" class="form-control" id="company" name="company" placeholder="Empresa">
                </div>
                <div class="col-md-6">
                    <label for="telephone" class="form-label">Telefone</label>
                    <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Telefone">
                </div>
                <div class="col-md-6">
                    <label for="cell" class="form-label">Celular</label>
                    <input type="text" class="form-control" id="cell" name="cell" placeholder="celular">
                </div>
                <div class="col-md-6">
                    <label for="inputState" class="form-label">Atividade</label>
                    <select id="inputState" class="form-select" name="activity">
                        <option>Estudante</option>
                        <option>Profissional</option>
                        <option>Associado</option>
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="curso" class="form-label">Curso</label>
                    <select id="curso" class="form-select" name="course">
                        @for ($i = 0; $i < $names['count']; $i++)
                            <option>{{ $names[$i]['name'] }}</option>
                        @endfor
                    </select>
                </div>
                <div class="col-md-6">
                    <label for="password" class="form-label">Senha</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="Senha">
                </div>
                <div class="col-md-6">
                    <label for="passwordConfirme" class="form-label">Confirmar senha</label>
                    <input type="password" class="form-control" id="passwordConfirme" name="passwordConfirme" placeholder="Confirmar senha">
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