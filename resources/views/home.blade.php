<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Bootstrap demo</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
    </head>
    <body>
        <h1>Home</h1>
        <div class="d-grid gap-2 col-4 border border-danger  p-2 with-3d-shadow">
            <button class="btn btn-warning" id="registrations" type="button">Incrições</button>
            <button class="btn btn-warning" id="listRegistrations" type="button">Listar/Editar inscrições</button>
            <button class="btn btn-warning" id="newCourse" type="button">Novo Curso</button>
            <button class="btn btn-warning" id="listCourses" type="button">Lista de cursos</button>
            <button class="btn btn-warning" id="userRegistration" type="button" action="/teste">Cadastro de Usuários</button>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script>
        document.getElementById('registrations').addEventListener('click', function () {
            window.location.href = '/registrations';
        });
        document.getElementById('listRegistrations').addEventListener('click', function () {
            window.location.href = '/listRegistrations';
        });
        document.getElementById('newCourse').addEventListener('click', function () {
            window.location.href = '/newCourse';
        });
        document.getElementById('listCourses').addEventListener('click', function () {
            window.location.href = '/listCourses';
        });
        document.getElementById('userRegistration').addEventListener('click', function () {
            window.location.href = '/userRegistration';
        });
    </script>
</html>