<html class="loading" lang="pt-br" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Sistema de Informação Piscicultura Bom Jardim">
    <meta name="keywords" content="sistema, bom jardim, piscicultura bom jardim">
    <meta name="author" content="Bom Jardim">
    <title>MoradaFisher - Login</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f4c455378e.js" crossorigin="anonymous"></script>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="bg-gradient-primary sidebar-toggled">

    <div class="container">

        <!-- Outer Row -->
        <div class="row justify-content-center">

            <div class="col-xl-10 col-lg-12 col-md-9">

                <div class="card o-hidden border-0 shadow-lg my-5">
                    <div class="card-body p-0">
                        <!-- Nested Row within Card Body -->
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="p-5">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Autenticação</h1>
                                    </div>
                                    <form class="form form-vertical" action="{{route('admin.login')}}" method="post">
                                      {{ csrf_field() }}
                                      <div class="form-body">
                                        <div class="row">
                                          <div class="col-12">
                                            <div class="form-group">
                                              <label for="email-id-icon">Email</label>
                                              <div class="position-relative has-icon-left">
                                                <input type="email" class="form-control" name="email"  id="email" placeholder="Digite seu email">
                                                <div class="form-control-position">
                                                  <i style="top: 8px" class="bx bx-mail-send"></i>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="row">
                                          <div class="col-12">
                                            <div class="form-group">
                                              <label for="password-id-icon">Senha</label>
                                              <div class="position-relative has-icon-left">
                                                <input type="password" class="form-control" name="password"  id="password" placeholder="Digite sua senha">
                                                <div class="form-control-position">
                                                  <i style="top: 8px" class="bx bx-lock"></i>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                      </div>
                                      <div class="form-group d-flex flex-md-row flex-column justify-content-between align-items-center">
                                          <div class="text-left">

                                          </div>
                                          <div class="text-right">
                                            <a href="{{route('admin.login.reset')}}" class="card-link"><small>Esqueci minha senha?</small></a>
                                          </div>
                                      </div>
                                        <button type="submit" class="btn btn-primary glow w-100 position-relative">Login <i
                                                class="bx bx-right-arrow-alt"></i></button>
                                    </form>
                                    <hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>

    <!-- Custom scripts for all pages-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/f4c455378e.js" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.js" integrity="sha512-0XDfGxFliYJPFrideYOoxdgNIvrwGTLnmK20xZbCAvPfLGQMzHUsaqZK8ZoH+luXGRxTrS46+Aq400nCnAT0/w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- END: Theme JS-->
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->

    <script src="{{ asset('js/sb-admin-2.js') }}"></script>

    @if(Session::has('mensagem'))
    <script type="text/javascript">
     $(document).ready(function() {
        swal({
          title: "{{ Session::get('mensagem')['title'] }}",
          text: "{{ Session::get('mensagem')['msg'] }}",
          icon: "{{ Session::get('mensagem')['icon'] }}",
          button: "Confirmar",
        });
     });
    </script>
    @endif

  </body>
  <!-- END: Body-->
</html>
