<div class="modal fade" id="modalCargaMasiva" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content w-75 mx-auto">
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
                        <select class="form-control" id="rol" name="rol" required>
                            <option value="">Seleccione un tipo de usuario</option>
                            @foreach($roles as $rol)
                                <option value="{{ $rol->id }}">{{ $rol->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="archivo" class="d-block mb-2">Archivo CSV</label>
                        <div class="align-items-center gap-2">
                            <label class="btn btn-success btn-icon-split" for="archivo">
                                <span class="icon text-white-50">
                                    <i class="fas fa-fw fa-folder"></i>
                                </span>
                                <span class="text">Cargar Archivo</span>
                            </label>
                            <span class="file-name text-truncate"
                                    id="archivo-nombre" readonly>
                                    Seleccione un archivo Seleccionado
                            </span>
                            <input type="file" class="d-none" id="archivo" 
                                    name="archivo" accept=".csv" required 
                                    onchange="document.getElementById('archivo-nombre').textContent = this.files[0].name">
                        </div>
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

