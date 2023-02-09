<html class="loading" lang="pt-br" data-textdirection="ltr">
  <!-- BEGIN: Head-->
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="description" content="Sistema de Informação Piscicultura Bom Jardim">
    <meta name="keywords" content="sistema, bom jardim, piscicultura bom jardim">
    <meta name="author" content="Bom Jardim">
    <title>MoradaFisher - Resetar</title>
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,500,600%7CIBM+Plex+Sans:300,400,500,600,700" rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
    <link href="{{ asset('css/sb-admin-2.css') }}" rel="stylesheet">
    <script src="https://kit.fontawesome.com/f4c455378e.js" crossorigin="anonymous"></script>

  </head>
  <!-- END: Head-->

  <!-- BEGIN: Body-->
  <body class="bg-gradient-primary sidebar-toggled">
    <!-- BEGIN: Content-->
        <!-- BEGIN: Content-->
        <div class="container">

                <div class="p-5">

                                       <!-- left lock screen section -->
                        <div class="col-md-12 col-12 px-0">
                          <div class="card disable-rounded-right mb-0 p-2">
                              <div class="card-content">
                                  <div class="card-body ">
                                    <div class="text-center">
                                        <h1 class="h4 text-gray-900 mb-4">Esqueci minha senha</h1>
                                    </div>
                                      @if (session('status'))
                                      <a href="{{route('lancamentos.index')}}">
                                          <div class="alert alert-success alert-dismissible mb-2" role="alert">
                                              <div class="d-flex align-items-center">
                                              <i class="bx bx-like"></i>
                                              <span>
                                                  {{ session('status') }}
                                              </span>
                                              </div>
                                          </div>
                                      </a>
                                      @else
                                      <div class="alert bg-rgba-danger alert-dismissible mb-2" role="alert">
                                          <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                          </button>
                                          <div class="align-items-center">
                                            <i class="bx bx-error"></i>
                                            <span>
                                              Por favor altere para prosseguir.
                                            </span><br>
                                            <span>Regras para cadastrar sua senha:</span>
                                            <ul>
                                              <li>Minímo de 8 caracteres</li>
                                              <li>Uma letra maiúscula e uma letra minúscula</li>
                                              <li>Deve conter números</li>
                                              <li>Um caracter símbolo. Ex: @!#$%</li>
                                            </ul>
                                          </div>
                                        </div>
                                      <div class="divider">
                                          <div class="divider-text text-uppercase text-muted"><small>Resetar Senha</small>
                                          </div>
                                      </div>
                                      <form class="form-horizontal" method="POST" action="{{ route('password.update', $token) }}">
                                        {{ csrf_field() }}
                                        <div class="row">
                                          <div class="col-12">
                                            <div class="form-group">
                                              <label for="email-id-icon">Email</label>
                                              <div class="position-relative has-icon-left">
                                                <input type="email" class="form-control" name="email"  id="email" placeholder="Confirme seu email">
                                                <div class="form-control-position">
                                                  <i style="top: 8px" class="bx bx-mail-send"></i>
                                                </div>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                          <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                              <label class="text-bold-600" for="password">Nova Senha</label>
                                              <input type="password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" id="password" name="password"
                                                  placeholder="Sua senha">
                                                  @if ($errors->has('password'))
                                                  <div class="invalid-feedback">
                                                      <i class="bx bx-radio-circle"></i>
                                                      {{ $errors->first('password') }}
                                                  </div>
                                              @endif
                                          </div>
                                          <div class="form-group{{ $errors->has('password_confirmation') ? ' has-error' : '' }}">
                                              <label class="text-bold-600" for="password">Confirmar Nova Senha</label>
                                              <input type="password" class="form-control {{ $errors->has('password_confirmation') ? ' is-invalid' : '' }}" id="password_confirmation" name="password_confirmation"
                                                  placeholder="Sua senha">
                                                  @if ($errors->has('password_confirmation'))
                                                  <div class="invalid-feedback">
                                                      <i class="bx bx-radio-circle"></i>
                                                      {{ $errors->first('password_confirmation') }}
                                                  </div>
                                              @endif
                                          </div>

                                          <button type="submit" class="btn btn-primary glow w-100 position-relative">Confirmar <i
                                                  class="bx bx-save"></i></button>
                                      </form>
                                      @endif
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>


      </div>

    @livewireScripts

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
        <!-- END: Theme JS-->
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <!-- BEGIN: Page JS-->
        <!-- END: Page JS-->

    <!-- END: Theme JS-->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>    <!-- BEGIN: Page JS-->
    <!-- END: Page JS-->
  </body>
  <!-- END: Body-->
</html>
