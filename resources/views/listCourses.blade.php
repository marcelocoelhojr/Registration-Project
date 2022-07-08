<!doctype html>
<?php 
    $count = 1;
    $total = 0;
    $regex = ['id', 'created_at', 'updated_at'];
?>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <style>
            table {
                font-family: arial, sans-serif;
                border-collapse: collapse;
                width: 100%;
            }
                                
            td, th {
                border: 1px solid #dddddd;
                text-align: left;
                padding: 8px;
            }
                                
            tr:nth-child(even) {
                background-color: #dddddd;
            }
        </style>
    </head>
    <body>
        <div class="m-3">
            <h1 class="">Lista de cursos</h1>
        </div>
        <div class="m-3">
            <table>
                <tr>
                    <th>Nome</th>
                    <th>Descrição</th>
                    <th>Valor</th>
                    <th>Data de Início</th>
                    <th>Data de término</th>
                    <th>Limite de alunos</th>
                    <th>Arquivo</th>
                </tr>
                @for ($i = 0; $i < $data['count']; $i++)
                    <tr>
                        @foreach ($data[$i] as $key => $course)
                            @if (!in_array($key, $regex))
                                <td> {{ $course }}</td>
                            @endif
                        @endforeach
                    </tr>
                @endfor
            </table>
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
</html>