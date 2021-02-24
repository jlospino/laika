@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <h5>Creación De Usuario</h5>
            <form action="{{ route('users.store') }}" method="POST" class="mt-3">
                @csrf
                <div class="row">
                    <div class="form-group col-lg-6">
                        <label>Nombre</label>
                        <input type="text" class="form-control form-control-lg" name="name" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Dirección De Residencia</label>
                        <input type="text" class="form-control form-control-lg" name="address" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Correo Electrónico</label>
                        <input type="email" class="form-control form-control-lg" name="email" required>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Tipo De Documento</label>
                        <select class="form-control form-control-lg" name="document_type_id" required>
                            <option value="">Seleccionar</option>
                            @forelse ($document_types as $item)
                                <option value="{{ $item->id }}"> {{ $item->description }}</option>
                            @empty

                            @endforelse
                        </select>
                    </div>
                    <div class="form-group col-lg-6">
                        <label>Número De Identificación</label>
                        <input type="text" class="form-control form-control-lg" name="document" required>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group mt-2">
                            <button type="button" class="btn btn-primary btn-lg" id="btn_submit_add_user">
                                Registrar Usuario
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
