<div class="modal fade" id="modalCargaMasiva" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Carga Masiva de Usuarios</h5>
                <button type="button" class="close" data-dismiss="modal">×</button>
            </div>
            <div class="modal-body">
                <form id="formUsuarioMasivo" enctype="multipart/form-data">
                <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    @method('POST')
                    <div class="form-group">
                        <label for="rol">Tipo de Usuario</label>
                        <select class="form-control" id="rol" name="rol">
                            <option value="">Seleccione un tipo de usuario</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="archivo">Archivo CSV</label>
                        <input type="file" class="form-control-file" id="archivo" name="archivo" accept=".csv" required>
                        <small class="form-text text-muted">
                            El archivo debe estar en formato CSV y contener las siguientes columnas: nombres, apellidos, dni, celular, correo_inst, sexo, provincia, distrito
                        </small>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-primary" id="btnCargar">Cargar Usuarios</button>
            </div>
        </div>
    </div>
</div>
