<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login | UserTrack</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/admin-lte@3.2/dist/css/adminlte.min.css">
  <script src="https://accounts.google.com/gsi/client" async defer></script>
  <style type="text/css">
    .btn-google {
      background-color: #dd4b39;
      color: #fff;
      border-color: #dd4b39;
    }

    .btn-google:hover {
      background-color: #c23321;
      border-color: #c23321;
    }

  </style>
</head>

<body class="hold-transition login-page">
  <div class="login-box">
    <div class="card card-outline card-primary">
      <div class="card-header text-center">
        <a href="../../index2.html" class="h1"><b>Use</b>Track</a>
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

          <div class="mt-3 border-top text-center">
            <span class="border px-2 mt-2 mb-3 bg-white">Login Social</span>
          </div>

          <a href="{{ route('authGoogle') }}" class="btn btn-primary btn-google w-100 mb-2 mt-4">
            <i class="fab fa-google me-2"></i> Login com Google
          </a>

          <a href="#" class="btn btn-primary btn-facebook w-100">
            <i class="fab fa-facebook-f me-2"></i> Login com Facebook
          </a>
     
      </div>
    </div>
  </div>

  <script src="https://kit.fontawesome.com/9f80d4c9ea.js" crossorigin="anonymous"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="adminlte/dist/js/adminlte.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

  <script type="text/javascript">
      $(document).ready(function() {
      $('#form').submit(function(event) {
          event.preventDefault();

          var formData = $(this).serialize();

          $.ajax({
              url: '{{ route("login") }}',
              type: 'POST',
              data: formData,
              dataType: 'json',
              success: function(response) {
                  if (response === true) {
                      alert('Usuário Logado');
                      window.location.href = '{{ route('dashboard') }}';
                  } else {
                      alert('Credenciais inválidas');
                      console.log(response);
                  }
              },
              error: function(xhr, status, error) {
                  // Tratar erros caso ocorram
                  console.log(error);
              }
          });
      });
  });

  </script>

</body>
</html>
