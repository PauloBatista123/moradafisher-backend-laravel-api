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
                    <li class="breadcrumb-item active"><a href="{{route('admin.cadastro.usuarios')}}"><i class="fas fa-home"></i></a>
                    </li>

                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
<div class="content-body"><!-- users list start -->
      <section class="users-list-wrapper">
          <div class="users-list-table">
			@livewire('cadastro.usuarios.index')
              
          </div>
      </section>
    </div>
  </div>
</div>
<div class="widget-chat-demo"><!-- widget chat demo footer button start -->
<button class="btn btn-primary chat-demo-button glow px-1" onclick="window.location.href='{{route('admin.cadastro.usuarios.adicionar')}}'"><i class="fas fa-user-plus"
    data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i> Adicionar</button>
    </div>

@endsection