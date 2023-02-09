				<div class="col-md-6 col-lg-3">
                    <div class="form-group">
                      <label for="autor">Nome<span style="color: red;">*</span></label>
                      <div class="controls">
                        <input type="text" name="name" id="name" class="form-control"  required 
                          data-validation-required-message="Usuário" placeholder="Ex: Ailton" value="{{(isset($usuario->name) ? $usuario->name : '')}}"
                          >
                      </div>
                    </div>
                </div>

				<div class="col-md-6 col-lg-3">
					<div class="form-group">
						<label for="documento">Email<span style="color: red;">*</span></label>
						<div class="controls">
							<input type="text" id="email" class="form-control" placeholder="Email" name="email" value="{{(isset($usuario->email) ? $usuario->email : '')}}" required>
						</div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="form-group">
						<label for="documento">Senha<span style="color: red;">*</span></label>
						<div class="controls">
							<input type="password" id="password" class="form-control" placeholder="Senha" name="password" ata-validation-required-message="Digite a senha" required>
						</div>
						<div id="senhaBarra" class="progress" style="display: none;">
					        <div id="senhaForca" class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 100%; height: 1.5rem;">
					        </div>
					    </div>
					</div>
				</div>
				<div class="col-md-6 col-lg-3">
					<div class="form-group">
					<label for="documento">Foto Perfil</label>
					<div class="controls">
							<div class="custom-file">
				              <input type="file" class="custom-file-input" id="file" name="file" accept="image/*">
				              <label class="custom-file-label" for="file">Selecionar Arquivo</label>
				            </div>
						</div>
					</div>
				</div>
