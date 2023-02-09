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
    <!-- BEGIN: Content-->
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
                                      <h1 class="h4 text-gray-900 mb-4">Esqueci minha senha</h1>
                                  </div>
                                        @if (session('status'))
                                        <a href="{{route('admin.index')}}">
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
                                                Sua senha está expirada ou nunca foi alterada. Por favor altere para prosseguir.
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
                                            <div class="divider-text text-uppercase text-muted"><small>SENHA EXPIRADA</small>
                                            </div>
                                        </div>
                                        <form class="form-horizontal" method="POST" action="{{ route('password.post_expired') }}">
                                          {{ csrf_field() }}

                                            <div class="form-group{{ $errors->has('current_password') ? ' has-error' : '' }}">
                                                <label class="text-bold-600" for="password">Senha Atual</label>
                                                <input type="password" class="form-control {{ $errors->has('current_password') ? ' is-invalid' : '' }}" id="current_password" name="current_password"
                                                    placeholder="Sua senha">
                                                    @if ($errors->has('current_password'))
                                                    <div class="invalid-feedback">
                                                        <i class="bx bx-radio-circle"></i>
                                                        {{ $errors->first('current_password') }}
                                                    </div>
                                                @endif
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
                                        <hr>
                                      </div>
                                  </div>
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

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

  </body>
</html>
