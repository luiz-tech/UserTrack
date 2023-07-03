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
    </head>
    <body class="sb-nav-fixed">
        
        {{ view('header') }}

            <!-- Meio da Página -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Lista de Usuários</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active">Usuários de UserTrack</li>
                        </ol>
                       
                        <div class="row">
                            <div class="col-xl-12">
                                
                        <div class="card mb-12">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Consulte os Produtos
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Nome</th>
                                            <th>Categoria</th>
                                            <th>Preço (R$)</th>
                                            <th>Qt. Estoque</th>
                                            <th>Prazo</th>
                                            <th>Criado em:</th>
                                            <th>Atualizado em:</th>
                                            <th>Ações</th>
                                        </tr>
                                    </thead>
                                    
                                    <tbody>
                                        @foreach($products as $p)
                                        <tr>
                                            <td>{{$p->nome}}</td>
                                            <td>{{$p->categoria}}</td>
                                            <td>{{number_format($p->preco,2)}}</td>
                                            <td>{{$p->qtd_estoque}}</td>
                                            <td>{{$p->prazo}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->updated_at)->format('d/m/Y')}}</td>
                                            <td>{{\Carbon\Carbon::createFromFormat('Y-m-d H:i:s', $p->updated_at)->format('d/m/Y')}}</td>
                                            <td>
                                                <a href="{{ route('editnewproduct',['id'=>$p->id,'user'=>$p->usuario_id])}}" type="button"class="btn btn-success">Editar</a>

                                                <a type="button" onclick="confirmDelete({{$p->id}});"class="btn btn-danger">Excluir</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </main>
                
                {{ view('footer') }}

                <script type="text/javascript">
                    
                    function confirmDelete(id) 
                    {
                        Swal.fire({
                          title: 'Confirmação',
                          text: "Tem certeza que deseja excluir permanetntemente esse esse produto?",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: 'green',
                          cancelButtonColor: 'red',
                          confirmButtonText: 'Confirmar',
                          cancelButtonText: 'Cancelar',

                        }).then((result) => {
                          if (result.isConfirmed) 
                          {
                            
                    $.ajax({
                        url: '{{ route("deleteproduct") }}',
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
        </div>
    </body>
</html>
