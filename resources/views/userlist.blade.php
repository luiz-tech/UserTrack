<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>Dashboard | UserTrack</title>
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    <link href="teamplates/css/styles.css" rel="stylesheet" />
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    <script defer src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" integrity="sha384-rOA1PnstxnOBLzCLMcre8ybwbTmemjzdNlILg8O7z1lUkLXozs4DHonlDtnE7fpc" crossorigin="anonymous"></script>
</head>
<body class="sb-nav-fixed">

    {{ view('header') }}

    <!-- Meio da Página -->
    <div id="layoutSidenav_content">
        <main>
            <div class="container-fluid px-4 mb-5">
                
                <div class="row mt-5">
                    <div class="col-10">
                        <h1 class="mt-4">Lista de Usuários</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Usuários de UserTrack</li>
                        </ol>                        
                    </div>
                    <div class="col-2 mt-5">
                        <a type="button" href="{{ route('newuser') }}" class="btn btn-outline-success">Novo Usuário</a>
                    </div>
                </div>

                <div class="row">
                    <div class="col-xl-12">

                        <div class="card mb-12">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Consulte os Usuários
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr class="align-middle">
                                            <th>Código</th>
                                            <th>Nome</th>
                                            <th>E-mail</th>
                                            <th>CPF</th>
                                            <th>Nivel</th>
                                            <th>Entrou em:</th>
                                            <th>Atualizado em:</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($users as $user)
                                        <tr>
                                            <td>{{$user->id}}</td>
                                            <td>{{ $user->nome }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->cpf }}</td>

                                            <td>
                                                @switch($user->nivel)
                                                @case('A')
                                                    <span class="badge badge-success bg-success">Administrador</span>
                                                    @break

                                                @case('S')
                                                    <span class="badge badge-secondary bg-secondary">Suporte</span>
                                                    @break

                                                @case('C')
                                                    <span class="badge badge-info bg-info">Cliente</span>
                                                    @break

                                                @default
                                                    <span class="badge badge-danger">Desconhecido</span>
                                            @endswitch
                                            </td>


                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->created_at)->format('d/m/Y')}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $user->updated_at)->format('d/m/Y')}}</td>
                                            <td>
                                                <a title="Editar Usuário" type="button" href="{{ route('edituser',['id' => $user->id]) }}"class="btn btn-outline-info"><i class="fa-solid fa-pen-to-square"></i></a>
                                                <a title="Excluir Usuário" type="button" onclick="confirmDelete({{$user->id}});" class="btn btn-outline-danger"><i class="fa-solid fa-trash-can"></i></a>
                                                <a title="Ver Produtos de {{ $user->nome }}" type="button" href="{{ route('productlist',['id' => $user->id]) }}" class="btn btn-outline-primary"><i class="fa-solid fa-nfc-magnifying-glass"></i></a>
                                                <a title="Criar Novo Produto para {{ $user->nome }}" type="button" href="{{ route('newproduct',['id' => $user->id]) }}" class="btn btn-outline-success"><i class="fa-solid fa-plus"></i></a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="card-footer">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

        {{ view('footer') }}

        <script type="text/javascript">
            function confirmDelete(id) {
                Swal.fire({
                    title: 'Confirmação',
                    text: "Tem certeza que deseja excluir permanentemente esse usuário?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: 'green',
                    cancelButtonColor: 'red',
                    confirmButtonText: 'Confirmar',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: '{{ route("deleteuser") }}',
                            method: 'GET',
                            data: {'id': id},
                            success: function(response) {
                                // Lógica de sucesso da requisição
                                location.reload(true);
                            },
                            error: function(xhr, status, error) {
                                // Lógica de erro da requisição
                                alert('ERRO: ' + error);
                            }
                        });
                    }
                });
            }
        </script>
    </div>
</body>
</html>
