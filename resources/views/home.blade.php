<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Api Laravel - Myra</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>

    <main>
        <div class="container">

            <h1 style="padding-top: 20px;">Crud com Laravel</h1>
            <p class="lead">Cadastro de Produtos utilizando Laravel - Teste Myra</p>
            <br>

            <div class="">
                <button class="btn btn-success btn-sm" type="button" onclick="abrirModal()" style="margin-bottom: 20px;">Adicionar</button>
            </div>

            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Id</th>
                            <th scope="col">Nome</th>
                            <th scope="col">Valor</th>
                            <th scope="col">Descrição</th>
                            <th scope="col" style="text-align: center;">Ação</th>
                        </tr>
                    </thead>

                    <tbody id='dadosTabela'></tbody>

                </table>
            </div>
    </main>



    <!-- MODAL CADASTRO E EDIÇÃO -->
    <div class="modal fade" id="modal" tabindex="-1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id='tituloModal'></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    ...
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-bs-dismiss="modal">Fechar</button>
                    <button type="button" class="btn btn-success">Salvar</button>
                </div>
            </div>
        </div>
    </div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>


    <script>
        var url = 'api/myra';

        listarDados();

        function abrirModal(id = null) {
            $('#modal').modal('show');
            var titulo = id ? 'Editar' : 'Adicionar';
            $('#tituloModal').html(titulo);
        }

        function inserirEditar(id = null) {

        }

        function deletar(id) {
            $.ajax({
                "url": url + '/' + id,
                "type": 'DELETE',
                'headers': {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
                success: function(data) {
                    $("#linha_" + id).remove();
                }
            });
        }

        function listarDados() {
            $.ajax({
                'url': url,
                'type': 'GET',
                success: function(data) {
                    var linha = '';
                    data.forEach(function(item) {
                        linha += tableTd(item)
                    });
                    $('#dadosTabela').html(linha);
                }
            });
        }

        function tableTd(dados) {
            var valor = '<tr id="linha_' + dados.id + '">' +
                '<td>' + dados.id + '</td>' +
                '<td>' + dados.nome + '</td>' +
                '<td>' + dados.valor + '</td>' +
                '<td>' + dados.descricao + '</td>' +
                '<td style="text-align: center; width:180px;">' +
                '<div class="">' +
                '<button class="btn btn-warning btn-sm" type="button" onclick="abrirModal(' + dados.id + ')">Editar</button> ' +
                '<button class="btn btn-danger btn-sm" type="button" onclick="deletar(' + dados.id + ')">Excluir</button>' +
                '</div>' +
                '</td>' +
                '</tr>';
            return valor;
        }
    </script>

</body>

</html>