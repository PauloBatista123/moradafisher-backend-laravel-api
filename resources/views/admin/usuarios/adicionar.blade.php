@extends('layout.admin_cadastro')

@section('content')

<div class="app-content content">
      <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Usuários</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item"><a href="{{route('admin.cadastro.usuarios')}}"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><a href="#"> Cadastrar Usuários</a>
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
                        <h5 class="card-title"><i class="fas fa-user-plus font-medium-5 align-middle"></i> Cadastrar Usuário</h5>
                      </div>
                      <div class="card widget-overlay-content mb-0">
                        <div class="card-body px-0 pb-0">
                                <div class="card-content">
                              <div class="card-body">
                                <form class="" action="{{ route('admin.cadastro.usuarios.salvar') }}" method="post">
                                  <div class="form-body">
                                    <div class="row">
						
										{{ csrf_field() }}
										@include('admin.cadastro.usuarios._form')

										<div class="col-12 d-flex justify-content-end">
                                        <button class="btn btn-primary mr-1 mb-1">Salvar</button>
                                        <button onclick="window.location.href='{{route('admin.cadastro.usuarios')}}'" type="reset" class="btn btn-light-secondary mr-1 mb-1">Voltar</button>
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
  </div>
</div>

