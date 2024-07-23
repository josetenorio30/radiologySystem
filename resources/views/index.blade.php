@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Estudios Pendientes</h1>
    <div class="row">
        @foreach ($pendingStudies as $study)
            <div class="col-md-6">
                <div class="card mb-3">
                    <div class="card-header">
                        Estudio de {{ $study->id_paciente }}
                    </div>
                    <div class="card-body">
                        <h5 class="card-title">Paciente</h5>
                        <p class="card-text">ID Paciente: {{ $study->id_paciente }}</p>

                        <h5 class="card-title">Estudio</h5>
                        <p class="card-text">Modalidad: {{ $study->modalidad }}</p>
                        <p class="card-text">Nombre del Estudio: {{ $study->nombre_estudio }}</p>
                        <p class="card-text">ID de Imagen: {{ $study->id_imagen }}</p>

                        <h5 class="card-title">Orden</h5>
                        <p class="card-text">ID de Orden: {{ $study->id_orden }}</p>

                        <form method="POST" action="{{ route('readings.store') }}">
                            @csrf
                            <input type="hidden" name="id_paciente" value="{{ $study->id_paciente }}">
                            <input type="hidden" name="id_orden" value="{{ $study->id_orden }}">
                            <div class="form-group">
                                <label for="intensidad_media">Intensidad Media</label>
                                <input type="number" name="intensidad_media" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="birads">Birads</label>
                                <select name="birads" class="form-control" required>
                                    <option value="normal">Normal</option>
                                    <option value="benigno">Benigno</option>
                                    <option value="sospechoso">Sospechoso</option>
                                    <option value="maligno">Maligno</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="vol_agua">Volumen de Agua</label>
                                <input type="number" name="vol_agua" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="vol_tot">Volumen Total</label>
                                <input type="number" name="vol_tot" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="hallazgos">Hallazgos</label>
                                <textarea name="hallazgos" class="form-control" required></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
