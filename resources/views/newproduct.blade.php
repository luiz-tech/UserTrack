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
                        <h1 class="mt-4">Novo Produto</h1>
                        
                        <div class="row">
         
                        	<!-- FORMULÁRIO -->
                        	<div class="card card-light">
							<div class="card-header">
							<h3 class="card-title">Cadastre um novo Produto</h3>
							</div>

							<div class="card-body">
							<!-- ...código anterior... -->


<form id="form">
  @csrf
  <div class="form-group">
    <label for="nome">Nome</label>
    <input type="text" class="form-control" id="nome" name="nome" required>
  </div>
  
  <div class="form-group">
    <label for="categoria">Categoria</label>
    <select class="form-control" id="categoria" name="categoria" required>
      <option value="">Selecione a categoria</option>
      <option value="Limpeza">Limpeza</option>
      <option value="Laticínios">Laticínios</option>
      <option value="Frios">Frios</option>
      <option value="Padaria">Padaria</option>
      <option value="Doces">Doces</option>
      <option value="Estética">Estética</option>
    </select>

  </div>
  
  <div class="form-group">
    <label for="prazo">Prazo de Validade</label>
    <input type="number" class="form-control" id="prazo" name="prazo" required>
  </div>
  
  <div class="form-group">
    <label for="preco">Preço</label>
    <input type="number" step="0.01" class="form-control" id="preco" name="preco" required>
  </div>
  
  <div class="form-group">
    <label for="quantidade">Quantidade em Estoque</label>
    <input type="number" class="form-control" id="quantidade" name="quantidade" required>
  </div>
  
  <input type="hidden" name="user_id" id="user_id" value="{{request()->get('id')}}">
  <button type="submit" class="btn btn-primary">Criar Novo Produto</button>
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
				      url: '{{ route("storenewproduct") }}',
				      method: 'POST',
				      data: formData,

				      success: function(response) {
				        // Lógica de sucesso da requisição
				        alert(response);
  				      if(response.status == true)
  			        {	
                  alert('Usuário Cadastrado com Sucesso '); 
                  $('#form')[0].reset();//limpeza do formulário
  				    	
                } else if(response.status == false){

  				    		alert('ERRO: '+response.msg);
  				    	}
				 
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
