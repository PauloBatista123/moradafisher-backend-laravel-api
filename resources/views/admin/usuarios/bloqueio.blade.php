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
                    <li class="breadcrumb-item active"> Bloqueios
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
										<th>Email</th>
										<th>Ip</th>
										<th>Data</th>
									</tr>
								</thead>
								<tbody>
									@foreach($bloqueios as $block)
									<tr>
										<td>{{ $block->id }}</td>
										<td>{{ $block->email }}</td>
										<td>{{ $block->ip }}</td>
										<td>{{ $block->created_at }}</td>
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