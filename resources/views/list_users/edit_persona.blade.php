<!-- Modal de edición de persona -->
<div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="editPersonaModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editPersonaModalLabel">Editar Persona</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="formEditPersona">
                    @csrf
                    <input type="hidden" id="persona_id" name="persona_id">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="codigo">Código</label>
                                <input type="text" class="form-control" id="codigo" name="codigo" required disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="dni">DNI</label>
                                <input type="text" class="form-control" id="dni" name="dni" required disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="nombres">Nombres</label>
                                <input type="text" class="form-control" id="nombres" name="nombres" required disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="apellidos">Apellidos</label>
                                <input type="text" class="form-control" id="apellidos" name="apellidos" required disabled>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="correo_inst">Correo Institucional</label>
                                <input type="email" class="form-control" id="correo_inst" name="correo_inst" required disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="celular">Celular</label>
                                <input type="tel" class="form-control" id="celular" name="celular" required disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="sexo">Género</label>
                                <select class="form-control" id="sexo" name="sexo" required disabled>
                                    <option value="">Seleccione su género</option>
                                    <option value="M">Masculino</option>
                                    <option value="F">Femenino</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departamento">Departamento</label>
                                <input type="text" class="form-control" id="departamento" name="departamento" required disabled>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="provincia">Provincia</label>
                                <input type="text" class="form-control" id="provincia" name="provincia" required disabled>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="distrito">Distrito</label>
                                <input type="text" class="form-control" id="distrito" name="distrito" required disabled>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-info btn-sm" id="btnEditar">
                    <i class="fas fa-edit"></i>    
                    Editar 
                </button>
                <button type="button" class="btn btn-success btn-sm d-none ml-2" id="btnActualizar">
                    <i class="fas fa-save"></i>
                    Actualizar
                </button>
            </div>
        </div>
    </div>
</div>

