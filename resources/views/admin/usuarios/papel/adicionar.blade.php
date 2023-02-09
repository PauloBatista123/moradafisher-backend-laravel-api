@extends('layout.admin_cadastro')

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
                    <li class="breadcrumb-item active"><a href="">Adicionar</a>
                    </li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
        </div>
<div class="content-body">
	<div class="row">
		<div class="col-12">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Adicionar Papel</h4>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="card-text">
							<p>Defina um novo papel para o sistema.</p>
						</div>
					<form class="" action="{{ route('admin.cadastro.papel.salvar') }}" method="post">
						{{ csrf_field() }}
						@include('admin.cadastro.papel._form')

						<div class="form-actions">
								<button type="submit" class="btn btn-primary">
									<i class="far fa-save"></i> Salvar
								</button>
						</div>
					</form>
				</div>
				</div>
			</div>
		</div>
			</div>
		</div>
	</div>
</div>




@endsection