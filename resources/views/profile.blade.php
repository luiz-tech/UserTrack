<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Editar Perfil | UserTrack</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
        <link href="teamplates/css/styles.css" rel="stylesheet" />
        <link href="adminlte/dist/css/adminlte.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        
        {{ view('header') }}

            <!-- Meio da Página -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Perfil</h1>
                        
                        <div class="row">
         
                        	<!-- FORMULÁRIO -->
                        	<div class="card card-light">
							<div class="card-header">
							<h3 class="card-title">Altere aqui as informações de perfil</h3>
							</div>

							<div class="card-body">
							<form id="form">
							@csrf
							<div class="row">
							<div class="col-sm-6">

							<div class="form-group">
							<label>Nome</label>
							<input name="name" class="form-control" placeholder="Nome Completo" value="{{ session('nome')}}"/>
							</div>
							</div>
							<div class="col-sm-6">
							<div class="form-group">
							<label>E-mail</label>
							<input type="text" class="form-control" placeholder="Informe um endereço de e-mail´válido" disabled=""value="{{ session('email')}}"/>
							</div>
							</div>
							</div>

							<div class="row">
							<div class="col-sm-6">

							<div class="form-group">
							<label>Entrou em:</label>
							<input class="form-control" placeholder="Entrou em:" disabled="" value="{{session('created_at')}}"/>
							</div>
							</div>

							<div class="col-sm-6">
							<div class="form-group">
							<label>Atualizado em:</label>
							<input class="form-control"placeholder="Atualizado em:" disabled=""value="{{session('updated_at')}}"/>
							</div>
							</div>

							</div>

							<div class="row">

							<div class='col-4'>		
							<div class="form-group">
							<label>CPF</label>
							<input class="form-control"placeholder="Atualizado em:" disabled="" value="{{session('cpf')}}" >
							</div>
							</div>

							<div class='col-4'>		
							<div class="form-group">
							<label>Data de Expiração</label>
							<input class="form-control"placeholder="Atualizado em:" disabled />
							</div>
							</div>

							<div class='col-4'>		
							<div class="form-group">
							<label>Nível de Usuário</label>
							<input class="form-control" placeholder="Atualizado em:" disabled 

							@if(session("nivel") == 'A')
							value="Usuário Administrador"
							@else value="Usuário Cliente"
							@endif
							/>
							</div>
							</div>

							</div>							
							</div>

							<div class="card-footer">
							<div class="row">
								<button id="btn-submit" type="submit" class="btn btn-primary">Salvar Alterações</button>
							</div>	
							</div>
							</form>

							</div>
                        </div>                  
                    </div>
                </main>
                
            {{ view('footer') }}

            </div>
        </div>
        

    	<script type="text/javascript">
    		
    		$(document).ready(function() {
			  $('#form').submit(function(e) {
			    e.preventDefault(); // Evita o envio padrão do formulário

			    // Coleta os dados do formulário
			    var formData = $(this).serialize();

			    $.ajax({
			      url: '{{ route("storeprofile") }}',
			      method: 'POST',
			      data: formData,

			      success: function(response) {
			        // Lógica de sucesso da requisição
			        alert('Usuário salvo com sucesso !');
			 
			      },

			      error: function(xhr, status, error) {
			        // Lógica de erro da requisição
			        alert('ERRO: ' + error);
			      }
    });
  });
});

    	</script>

    </body>
</html>
