<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Login | UserTrack</title>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">
<div class="login-box">

<div class="card card-outline card-primary">
<div class="card-header text-center">
<a href="../../index2.html" class="h1"><b>User</b>Track</a>
</div>
<div class="card-body">
<p class="login-box-msg">Entre com suas credenciais</p>

<form id="form">
	@csrf
<div class="input-group mb-3">
<input name="email" type="email" class="form-control" placeholder="Email" value="lcscfilho@gmail.com">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-envelope"></span>
</div>
</div>
</div>
<div class="input-group mb-3">
<input name="password" type="password" class="form-control" placeholder="Senha" value="123">
<div class="input-group-append">
<div class="input-group-text">
<span class="fas fa-lock"></span>
</div>
</div>
</div>
<div class="row">
<div class="col-8">
<div class="icheck-primary">
<input type="checkbox" id="remember">
<label for="remember">
Lembre-me
</label>
</div>
</div>

<div class="col-4">
<button type="submit" class="btn btn-primary btn-block">Entrar</button>
</div>

</div>
</form>
<!-- div class="social-auth-links text-center mt-2 mb-3">
<a href="#" class="btn btn-block btn-primary">
<i class="fab fa-facebook mr-2"></i> Sign in using Facebook
</a>
<a href="#" class="btn btn-block btn-danger">
<i class="fab fa-google-plus mr-2"></i> Sign in using Google+
</a>
</div -->

<p class="mb-1">
<a href="forgot-password.html">Esqueci minha Senha</a>
</p>
<p class="mb-0">
<a href="register.html" class="text-center">Registrar novo Membro</a>
</p>
</div>

</div>

</div>

<script src="https://kit.fontawesome.com/9f80d4c9ea.js" crossorigin="anonymous"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="adminlte/dist/js/adminlte.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- Script Ajax -->
<script>

$(document).ready(function() {
  $('#form').submit(function(e) {
    e.preventDefault(); // Evita o envio padrão do formulário

    // Coleta os dados do formulário
    var formData = $(this).serialize();

    $.ajax({
      url: '{{ route("login") }}', // Rota para onde a requisição será enviada
      method: 'POST', // Método HTTP da requisição
      data: formData, // Dados do formulário

      success: function(response) {
        // Lógica de sucesso da requisição
        alert('Usuário logado com sucesso');

        location.href = '{{ route("dashboard") }}';

      },

      error: function(xhr, status, error) {
        // Lógica de erro da requisição
        alert('As credenciais estão errdas');
      }

    });
  });
});
</script>

</body>
</html>
