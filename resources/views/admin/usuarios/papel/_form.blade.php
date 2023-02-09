<div class="col-md-6">
			<div class="form-group">
				<label for="autor">Nome<span style="color: red;">*</span></label>
				<input type="text" id="autor" class="form-control" placeholder="Nome" name="nome" value="{{(isset($registro->nome) ? $registro->nome : '')}}" required>
			</div>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="documento">Descrição do papel<span style="color: red;">*</span></label>
				<input type="text" id="desc" class="form-control" placeholder="Descrição do papel" name="desc" value="{{(isset($registro->descricao) ? $registro->descricao : '')}}" required>
			</div>
		</div>