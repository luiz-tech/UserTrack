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
        <link href="adminlte/dist/css/adminlte.min.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        
        {{ view('header') }}

            <!-- Meio da Página -->
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Editar Usuário</h1>
                        
                        <div class="row">
         
                        	<!-- FORMULÁRIO -->
                        	<div class="card card-light">
							<div class="card-header">
							<h3 class="card-title">Altere aqui as informações do Usuário </h3>
							</div>

							<div class="card-body">
							<!-- ...código anterior... -->

@foreach($user as $u)
<form id="form">
  @csrf
  <div class="row">
    <div class="col-sm-6">
      <div class="form-group">
        <label>Nome</label>
        <input value="{{ $u->nome }}" name="name" class="form-control" placeholder="Nome Completo" required/>
      </div>
    </div>
    <div class="col-sm-6">
      <div class="form-group">
        <label>E-mail</label>
        <input value="{{ $u->email }}" name="email" type="email" class="form-control" placeholder="Informe um endereço de e-mail válido" required/>
      </div>
    </div>
  </div>

  <div class="row">
    <div class='col-4'>		
      <div class="form-group">
        <label>CPF</label>
        <input value="{{ $u->cpf }}" name="cpf" class="form-control" placeholder="CPF" required>
      </div>
    </div>

    <div class='col-4'>		
      <div class="form-group">
        <label>Prazo</label>
        <input value="{{ $u->prazo }}" name="prazo" type="number" class="form-control" placeholder="Prazo" required>
      </div>
    </div>

    <div class='col-4'>		
      <div class="form-group">
        <label>Nível de Usuário</label>
        <select required name="nivel" class="form-control">
          <option value="" selected>Escolha um Nível</option>
          <option @if($u->nivel == 'A') selected @endif value="A">Administrador</option>
          <option @if($u->nivel == 'S') selected @endif  value="S">Suporte</option>
          <option @if($u->nivel == 'C') selected @endif  value="C">Usuário Comum</option>
        </select>
      </div>
    </div>
  </div>
  <input type="hidden" name="id" value="{{ $u->id }}">
  <div class="card-footer">
    <div class="row">
      <button id="btn-submit" type="submit" class="btn btn-primary">Salvar Alterações</button>
    </div>	
  </div>
</form>
@endforeach

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
				      url: '{{ route("updateuser") }}',
				      method: 'POST',
				      data: formData,

				      success: function(response) {
				        // Lógica de sucesso da requisição
				      
                alert(response.msg);
		 
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
