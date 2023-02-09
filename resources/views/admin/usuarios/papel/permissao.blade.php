@extends('layouts.padrao')

@push('styles')
<link rel="stylesheet" type="text/css" href="{{asset('css/toastr.min.css')}}">
@endpush
@section('content')

<div class="app-content content">
      <div class="content-overlay"></div>
      <div class="content-wrapper">
        <div class="content-header row">
          <div class="content-header-left col-12 mb-2 mt-1">
            <div class="row breadcrumbs-top">
              <div class="col-12">
                 <h5 class="content-header-title float-left pr-1 mb-0">Permissões de {{$papel->nome}}</h5>
                <div class="breadcrumb-wrapper col-12">
                  <ol class="breadcrumb p-0 mb-0">
                    <li class="breadcrumb-item active"><a href="{{route('admin.cadastro.papel')}}"><i class="fas fa-home"></i></a>
                    </li>
                    <li class="breadcrumb-item active"><a href="">Editar</a>
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
					<h4 class="card-title">Adicionar Permissões</h4>
				</div>
				<div class="card-content collapse show">
					<div class="card-body">
						<div class="card-text">
							<p>Adicione uma nova permissão para esse usuário</p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-12">
        <div class="table-responsive">
            <table class="table mt-1">
                <tbody>
                	{{csrf_field()}}
	                  	@foreach($grupo as $g)
							<tr>
								<td>{{$g->nome}}</td>
				                    @foreach($permissao as $p)
				                    	@if($p->grupo_permissao_id === $g->id)
					                    <td>
				                            <div class="checkbox">
							                    <input onchange="setPermission({{$p->id}}, {{$papel->id}})" type="checkbox" class="checkbox-input" id="{{$p->id}}" value="{{$p->id}}" name="permissao_id[]" @if(\App\Models\User::existePermissao($p->id, $papel->id)) checked @endif>
							                    <label for="{{$p->id}}">{{$p->descricao}}</label>
							                  </div>
				                        </td>
						                 @endif
									@endforeach
							</tr>
						@endforeach
                </tbody>
            </table>
        </div>
    </div>

	</div>

</div>
			</div>
		</div>


@endsection
@push('scripts')
	<script src="{{asset('js/toastr.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/jquery.inputmask.min.js')}}"></script>
	<script type="text/javascript" src="{{asset('js/cadastro.js')}}"></script>
	<script src="{{asset('js/format.js')}}"></script>
	<script src="{{asset('js/configuracao.js')}}"></script>

@endpush
