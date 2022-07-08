<!doctype html>
<?php 
    $regex = ['updated_at', 'address', 'company'];
?>
<html lang="pt">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-0evHe/X+R7YkIZDRvuzKMRqM+OrBnVFBL6DOitfPri4tjfHxaWutUpFmBp4vmVor" crossorigin="anonymous">
        <style>
            @media print {
                .hidden-print {
                    display: none;
                }
            }
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
            <h1 class="">Lista de inscritos</h1>
            <form method="GET" action="/listRegistrations">
                <div class="input-group container">
                    <input type="text" class="form-control" id="search" name="search" placeholder="Busca">
                    <select name="categoria" class="form-select">
                        <option selected>Profissional/Associado/Estudante</option>
                        <option>Profissional</option>
                        <option>Associado</option>
                        <option>Estudante</option>
                    </select>
                    <select name="campos" class="form-select">
                        <option selected>Nome/Data/CPF/Email</option>
                        <option>Nome</option>
                        <option>Data</option>
                        <option>CPF</option>
                        <option>Email</option>
                    </select>
                    <select name="status" class="form-select">
                        <option selected>Pago/Pendente</option>
                        <option>Pago</option>
                        <option>Pendente</option>
                    </select>
                    <button type="submit" class="btn btn-secondary">Pesquisar</button>
                </div>
            </form>
        </div>
        <div class="m-3">
            <table id="dvData">
                <tr class="pdf">
                    <th>Inscrito</th>
                    <th>Data de Incrição</th>
                    <th>Categoria</th>
                    <th>CPF</th>
                    <th>E-mail</th>
                    <th>UF</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th class="hidden-print">Ações</th>
                </tr>
                @for ($i = 0; $i < $data['count']; $i++)
                    <tr>
                        <td > {{ $data[$i]->name }} </td>
                        <input id="{{'name'.$data[$i]->id}}" value="{{$data[$i]->name}}" type="hidden">
                        <td> {{ $data[$i]->created_at }} </td>
                        <input id="{{'created'.$data[$i]->id}}" value="{{$data[$i]->created_at}}" type="hidden">
                        <td> {{ $data[$i]->activity }} </td>
                        <input id="{{'activity'.$data[$i]->id}}" value="{{$data[$i]->activity}}" type="hidden">
                        <td>  {{ $data[$i]->cpf }} </td>
                        <input id="{{'cpf'.$data[$i]->id}}" value="{{$data[$i]->cpf}}" type="hidden">
                        <td>  {{ $data[$i]->email }} </td>
                        <input id="{{'email'.$data[$i]->id}}" value="{{$data[$i]->email}}" type="hidden">
                        <td>  {{$data[$i]->uf}} </td>
                        <input id="{{'uf'.$data[$i]->id}}" value="{{$data[$i]->uf}}" type="hidden">
                        @if ($data[$i]->status == 0)
                            <td>pendente</td>
                            <input id="{{'status'.$data[$i]->id}}" value="pendente" type="hidden">
                        @else
                            <td>pago</td>
                            <input id="{{'status'.$data[$i]->id}}" value="pago" type="hidden">
                        @endif
                        <td>R$ {{ $data[$i]->course_value->value }} </td>
                        <td class="hidden-print"> 
                            <form method="POST" action="delete/registration/{{$data[$i]->id}}">
                                @method('delete')
                                @csrf
                                <button type="button" id="{{$data[$i]->id}}" class="btn btn-secondary" data-bs-toggle="modal" data-bs-target="#exampleModal" onclick="teste(id)">
                                    Editar
                                </button> 
                                <button type="submit" class="btn btn-danger">
                                    Excluir
                                </button> 
                            </form>
                        </td>
                    </tr>
            @endfor
            </table>
        </div>
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="Editar" id="exampleModalLabel">Editar</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form method="POST" action="/update/registration">
                        <div class="modal-body">
                                @csrf
                                <input type="text" id="nameEdit" class="form-control mt-3" value="" name="name">
                                <input type="text" id="cpfEdit" class="form-control mt-4" value="" name="cpf">
                                <input type="text" id="emailEdit" class="form-control mt-4" value="" name="email">
                                <select id="activityEdit" class="form-select mt-4" name="activity" value="">
                                    <option>Estudante</option>
                                    <option>Profissional</option>
                                    <option>Associado</option>
                                </select>
                                <input type="text" id="ufEdit" class="form-control mt-4" value="" name="uf">
                                <select id="statusEdit" class="form-select mt-4" name="status">
                                    <option value="0">pendente</option>
                                    <option value="1">pago</option>
                                    <input type="hidden" id="statusEdit" value="">
                                </select>
                                <input type="hidden" id="id" name="id" value="">
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                            <button type="submit" class="btn btn-primary">Salvar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-12 m-3">
            <button class="btn btn-danger" id="back">Voltar</button>
        </div> 
        <button type="button" class="btn btn-secondary" id="getPDF"  onclick="ExportPdf()">
            Exportar PDF
        </button> 
        <button type="button" class="btn btn-secondary" id="getXLS"  onclick="ExportXls()">
            Exportar XLS
        </button> 
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.bundle.min.js" integrity="sha384-pprn3073KE6tl6bjs2QrFaJGz5/SUsLqktiwsUTF55Jfv3qYSDhgCecCxMW52nD2" crossorigin="anonymous"></script>
    </body>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.5/dist/umd/popper.min.js" integrity="sha384-Xe+8cL9oJa6tN/veChSP7q+mnSPaj5Bcu9mPX5F5xIGE0DVittaqT5lorf0EI7Vk" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0-beta1/dist/js/bootstrap.min.js" integrity="sha384-kjU+l4N0Yf4ZOJErLsIcvOU2qSb74wXpOhqTvwVx3OElZRweTnQ6d31fXEoRD1Jy" crossorigin="anonymous"></script>
    <script>
        document.getElementById('back').addEventListener('click', function () {
            window.location.href = '/home';
        });
        function teste(id)
        {
            document.getElementById('nameEdit').value = document.getElementById('name'+id).value;
            document.getElementById('cpfEdit').value = document.getElementById('cpf'+id).value;
            document.getElementById('activityEdit').value = document.getElementById('activity'+id).value;
            document.getElementById('emailEdit').value = document.getElementById('email'+id).value;
            document.getElementById('ufEdit').value = document.getElementById('uf'+id).value;
            document.getElementById('id').value = id;
            let status;
            if (document.getElementById('status'+id).value === 'pago') {
                status = 1;
            } else {
                status = 0;
            }
            document.getElementById('statusEdit').value = status;
        }
        function ExportXls() {
            var a = document.createElement('a');
            var data_type = 'data:application/vnd.ms-excel';
            var table_div = document.getElementById('dvData');
            console.log(table_div.outerHTML.replace(/ /g, '%20'));
            var table_html = table_div.outerHTML.replace(/ /g, '%20');
            a.href = data_type + ', ' + table_html;
            a.download = 'inscritos.xls';
            a.lang ='pt-br';
            console.log(a);
            a.click();
            //e.preventDefault();
        }
        function ExportPdf()
        {
            $("table").printThis({
                importCSS: true,
                importStyle: true,
            });
        }
     
        
    </script>
    
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/2.3.4/jspdf.plugin.autotable.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.4.1/jspdf.debug.js" integrity="sha384-THVO/sM0mFD9h7dfSndI6TS0PgAGavwKvB5hAxRRvc0o9cPLohB0wb/PTA7LdUHs" crossorigin="anonymous"></script>
</html>