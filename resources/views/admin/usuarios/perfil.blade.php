@extends('layout.admin_cadastro')

@section('content')

<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                 <h5 class="content-header-title float-left pr-1 mb-0">{{$usuario->name}}</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item active"><a href="">Meu perfil</a>
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>

                    <!-- User Widget with Overlay Image Starts -->
                  <div class="col-12">
                    <div class="card widget-overlay">
                      <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="card-title"><i class="fas fa-user-edit font-medium-5 align-middle"></i> Meus dados</h5>
                      </div>
                      <div class="card widget-overlay-content mb-0">
                        <div class="card-body px-0 pb-0">
                                <div class="card-content">
                              <div class="card-body">
                                <form enctype="multipart/form-data" class="form form-vertical" id="formCadUsuario" method="post" action="{{route('admin.cadastro.usuarios.atualizar_perfil', encrypt($usuario->id))}}">
                                  <div class="form-body">
                                    <div class="row">
                      									@include('admin.cadastro.usuarios._form_perfil')
                      									{{ csrf_field() }}
                      									<div class="col-12 d-flex justify-content-end">
                                        <button type="submit" class="btn btn-primary mr-1 mb-1">Salvar</button>
                                      </div>
                                    </div>
                                  </div>
                                </form>
                              </div>
                            </div>
                            </div>
                      </div>
                    </div>
                  </div>
                  <!-- User Widget with Overlay Image Ends -->

                  @if (Auth()->user()->existePapel('SÓCIO'))
                  @php
                    $socio = Auth()->user()->socio_usuario->socio;
                  @endphp
                      <!-- User Widget with Overlay Image Starts -->
                   <div class="col-12">
                    <div class="card widget-overlay">
                      <div class="card-header border-bottom d-flex justify-content-between align-items-center">
                        <h5 class="card-title"><i class="fas fa-user font-medium-5 align-middle"></i> Meus dados no sistema</h5>
                      </div>
                      <div class="card widget-overlay-content mb-0">
                            <div class="card-content">
                              <div class="card-body">
                                <h5 class="card-title">{{$socio->nome}}</h5>
                                <ul class="list-unstyled">
                                  <li><i class="cursor-pointer bx bx-user-pin mb-1 mr-50"></i>{{$socio->documento}}</li>
                                  <li><i class="cursor-pointer bx bx-phone-call mb-1 mr-50"></i>{{$socio->telefone1}}</li>
                                  <li><i class="cursor-pointer bx bx-map mb-1 mr-50"></i>{{$socio->endereco}}, {{$socio->bairro}}, {{$socio->cidade}}, {{$socio->estado}}</li>
                                  <li><i class="cursor-pointer bx bx-calendar-heart mb-1 mr-50"></i>{{$socio->data_nascimento}}</li>
                                </ul>
                                <div class="row">
                                  <div class="col-6">
                                    <h6><small class="text-muted">Cargo</small></h6>
                                    <p>{{$socio->cargo}}</p>
                                  </div>
                                  <div class="col-6">
                                    <h6><small class="text-muted">Início do mandato</small></h6>
                                    <p>{{$socio->inicio_mandato}}</p>
                                  </div>
                                  <div class="col-6">
                                    <h6><small class="text-muted">Última alteração</small></h6>
                                    <p>{{$socio->updated_at}}</p>
                                  </div>
                                  <div class="col-6">
                                    <h6><small class="text-muted">Status</small></h6>
                                    <p>{{$socio->status}}</p>
                                  </div>
                                  <div class="col-12">
                                    <h6><small class="text-muted">Observações</small></h6>
                                    <p>{{$socio->observacao}}</p>
                                  </div>
                                </div>
                              </div>
                            </div>
                      </div>
                    </div>
                  </div>
                  <!-- User Widget with Overlay Image Ends -->
                  @endif
                  
  </div>
</div>


@endsection