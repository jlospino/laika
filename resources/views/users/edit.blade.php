@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5>Editar Usuario</h5>
            <form action="{{ route('users.update', $user->id) }}" method="PUT" id="formUpdateUser" name="formUpdateUser" class="mt-2">
                @csrf
                {{ method_field('PUT') }}
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-lg" name="name" value="{{ $user->name }}" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Dirección De Residencia</label>
                        <input type="text" class="form-control form-control-lg" name="address" value="{{ $user->address }}" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Correo Electrónico</label>
                        <input type="email" class="form-control form-control-lg" name="email" value="{{ $user->email }}" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Tipo De Documento</label>
                        <select class="form-control form-control-lg" name="document_type_id" required>
                            <option value="">Seleccionar</option>
                            @forelse ($document_types as $item)
                                <option value="{{ $item->id }}" {{ ( $user->document_type_id == $item->id) ? 'selected' : '' }}> {{ $item->description }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Número De Identificación</label>
                        <input type="text" class="form-control form-control-lg" name="document" value="{{ $user->document }}" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-primary btn-lg" id="btn_submit_edit_user">
                                Guardar Cambios
                            </button>
                            <a type="button" href="{{ url()->previous() }}" class="btn btn-secondary btn-lg">
                                Volver Al Inicio
                            </a>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
