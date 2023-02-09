@extends('layouts.padrao')

@section('content')

<div class="app-content content">
      <div class="content-overlay"></div>
    <div class="content-wrapper">
      <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                <h5 class="content-header-title float-left pr-1 mb-0">Papéis</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item active"><a href="{{route('admin.cadastro.papel')}}"><i class="fas fa-home"></i></a>
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
              <div class="card">
                  <div class="card-content">
                      <div class="card-body">
                          <!-- datatable start -->
                          <div class="table-responsive">
                             <table id="users-list" class="table table-source">
								<thead>
									<tr>
										<th>Id</th>
										<th>Nome</th>
										<th>Descrição</th>
										<th>Ação</th>
									</tr>
								</thead>
								<tbody>
									@foreach($registros as $registro)
									<tr>
										<td>{{ $registro->id }}</td>
										<td>{{ $registro->nome }}</td>
										<td>{{ $registro->descricao }}</td>
										<td>
											@if(Auth()->user()->existeAdmin())
											<a class="btn btn-outline-warning mr-1 mb-1" href="{{ route('admin.cadastro.papel.editar', $registro->id) }}"><i class="fas fa-edit"></i> Editar</a>
											@else
											<a class="btn btn-outline-warning mr-1 mb-1 disabled"><i class="fas fa-edit"></i> Editar</a>
											@endif
											@if(Auth()->user()->existeAdmin())
											<a class="btn btn-outline-success mr-1 mb-1" href="{{ route('admin.cadastro.papel.permissao', $registro->id) }}" ><i class="fas fa-user-check"></i> Permissão</a>
											@endif
											@if(Auth()->user()->existeAdmin())
											<a class="btn btn-outline-danger mr-1 mb-1" href="javascript:
																		Swal.fire({
																				title: 'Atenção',
																				text: 'Deseja realmente deletar essa permissão?',
																				icon: 'warning',
																				showCancelButton: true,
																				confirmButtonColor: '#3085d6',
																				cancelButtonColor: '#d33',
																				confirmButtonText: 'Confirmar'
																				}).then((result) => {
																						if (result.isConfirmed) {
					                                                    		window.location.href = '{{ route('admin.cadastro.papel.deletar', $registro->id)}}'
					                                                    	}

					                                                    });"><i class="fas fa-trash-alt"></i> Deletar</a>
											@else
											<a class="btn btn-outline-danger mr-1 mb-1 disabled"><i class="fas fa-trash-alt"></i> Deletar</a>
											@endif

										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
                      </div>
                  </div>
              </div>
          </div>
      </section>
    </div>
  </div>
</div>
   <div class="widget-chat-demo"><!-- widget chat demo footer button start -->
<button class="btn btn-primary chat-demo-button glow px-1" onclick="window.location.href='{{route('admin.cadastro.papel.adicionar')}}'"><i class="fas fa-plus"
    data-options="name: comments.svg; style: lines; size: 24px; strokeColor: #fff; autoPlay: true; repeat: loop;"></i> Adicionar</button>
    </div>

@endsection
