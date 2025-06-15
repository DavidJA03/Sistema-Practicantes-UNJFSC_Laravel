<div class="modal fade" id="modalRegistro" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Registro de Usuario</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <form id="formRegistro">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('POST')
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="codigo">Código</label>
                                        <input type="tel" class="form-control" id="codigo" name="codigo" required maxlength="10" pattern="\d{1,9}" oninput="completarCorreo()">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="dni">DNI</label>
                                        <input type="tel" class="form-control" id="dni" name="dni" required maxlength="8" pattern="\d{1,9}">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="celular">Celular</label>
                                        <input type="tel" class="form-control" id="celular" name="celular" required maxlength="9" pattern="\d{1,9}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombres">Nombres</label>
                                        <input type="text" class="form-control" id="nombres" name="nombres" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellidos">Apellidos</label>
                                        <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="correo_inst">Correo Institucional</label>
                                        <input type="email" class="form-control" id="correo_inst" name="correo_inst" placeholder="ejemplo@unjfsc.edu.pe" required>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="rol">Tipo de Usuario</label>
                                        <select class="form-control" id="rol" name="rol" required>
                                            <option value="">Seleccione un tipo de usuario</option>
                                            @foreach($roles as $rol)
                                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sexo">Género</label>
                                        <select class="form-control" id="sexo" name="sexo" required>
                                            <option value="">Seleccione su género</option>
                                            <option value="M">Masculino</option>
                                            <option value="F">Femenino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="departamento">Departamento</label>
                                        <input type="text" class="form-control" id="departamento" name="departamento" value="Lima Provincias" readonly>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="provincia">Provincia</label>
                                        <select class="form-control" id="provincia" name="provincia" required>
                                            <option value="">Seleccione una provincia</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="distrito">Distrito</label>
                                        <select class="form-control" id="distrito" name="distrito" required disabled>
                                            <option value="">Seleccione un distrito</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnRegistrar">Registrar</button>
            </div>
        </div>
    </div>
</div>