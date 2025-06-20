<table class="table table-bordered table-hover align-middle">
    <thead class="table-dark text-center">
        <tr>
            <th>ID</th>
            <th>Nombre de la Facultad</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody class="text-center">
        @foreach($facultades as $facultad)
        <tr id="fila-{{ $facultad->id }}">
            <td>{{ $facultad->id }}</td>
            <td>{{ $facultad->name }}</td> 
            <td>
                <div class="d-flex justify-content-center gap-2">
                    <form action="{{ route('facultad.edit', $facultad->id) }}" method="GET">
                        @csrf
                        <button class="btn btn-sm btn-warning">
                            <i class="bi bi-pencil-square"></i> Editar
                        </button>
                    </form>
                    <button class="btn btn-sm btn-danger" data-bs-toggle="modal" data-bs-target="#confirmModal-{{ $facultad->id }}">
                        <i class="bi bi-trash"></i> Eliminar
                    </button>
                </div>

                {{-- Modal de eliminación --}}
                <div class="modal fade" id="confirmModal-{{ $facultad->id }}" tabindex="-1" aria-labelledby="exampleModalLabel-{{ $facultad->id }}" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Confirmar Eliminación</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                            </div>
                            <div class="modal-body">¿Estás seguro de eliminar esta facultad?</div>
                            <div class="modal-footer">
                                <form action="{{ route('facultad.destroy', $facultad->id) }}" method="POST" class="form-eliminar" data-id="{{ $facultad->id }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<div class="d-flex justify-content-center mt-3">
    {{ $facultades->appends(request()->query())->links() }}
</div>
