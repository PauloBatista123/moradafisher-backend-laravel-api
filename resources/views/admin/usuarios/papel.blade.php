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
                    <li class="breadcrumb-item"><a href="{{route('admin.cadastro')}}"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item"><a href="{{route('admin.cadastro.usuarios')}}"><i class="fas fa-home"></i> Usuários</a>
                    </li>
                    <li class="breadcrumb-item active"><a href="#"><i class="fas fa-home"></i> Papéis Usuário</a>
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
				<div class="card-header">
					<h4 class="card-title">Usuário {{$usuario->name}}</h4>
				</div>
				<div class="card-content">
                      <div class="card-body">

					@if(!$usuario->papeis()->count())
						<div class="card-text">
							<p>Adicione um novo papel para esse usuário</p>
						</div>
					<form class="form form-vertical" id="formCadUsuario" action="{{ route('admin.cadastro.usuarios.papel.salvar', $usuario->id)}}" method="post">
                        <div class="form-body">
                            <div class="row">
						{{csrf_field()}}
								<div class="col-md-12 col-lg-12">
                    				<div class="form-group">
									<select name="papel_id" id="papel_id" class="form-control form-control-lg">
										@foreach($papeis as $p)
											<option value="{{$p->id}}">{{$p->nome}} - {{$p->descricao}}</option>
										@endforeach
									</select>
									</div>
								</div>
							 </div>
										<button type="submit" class="btn btn-primary mr-1 mb-1">
											<i class="far fa-save"></i> Salvar
										</button>
								
							</div>
						</div>
					</form>
					@endif

				 <div class="table-responsive">
                     <table id="users-list" class="table">
						<thead>
							<tr>
								<th>Papel</th>
								<th>descrição</th>
								<th>Ação</th>
							</tr>
						</thead>
						<tbody>
							@foreach($usuario->papeis as $papel)
							<tr>
								<td>{{ $papel->nome }}</td>
								<td>{{ $papel->descricao }}</td>
								<td>
									<a class="btn btn-outline-primary mr-1 mb-1" href="javascript: 
													swal({
                                                      title: 'Atenção',
                                                      text: 'Deseja realmente deletar esse Papel?',
                                                      icon: 'warning',
                                                      buttons: true,
                                                    }).then((willDelete) => {
                                                    	if(willDelete){
                                                    		window.location.href = '{{ route('admin.cadastro.usuarios.papel.remover', [$usuario->id, $papel->id])}}'
                                                    	}  
                                                     
                                                    });"><i class="fas fa-trash-alt"></i> Deletar</a>	

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


@endsection