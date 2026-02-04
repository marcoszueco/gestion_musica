<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar: {{ $album->title }}</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">

            {{-- 5. Verificar autorización básica en la vista --}}
            @if(Auth::id() !== $album->user_id)
                <div class="alert alert-danger">No tienes permiso para editar este álbum.</div>
            @else

                <div class="card shadow border-0">
                    <div class="card-header bg-dark text-white py-3 d-flex justify-content-between align-items-center">
                        <h4 class="mb-0">Editar Álbum</h4>
                        <span class="badge bg-secondary">ID: {{ $album->id }}</span>
                    </div>
                    <div class="card-body p-4">

                        {{-- El método para actualizar debe ser PUT o PATCH --}}
                        <form action="{{ route('album.update', $album) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                {{-- 2. Pre-rellenar formulario con datos existentes usando value="{{ old('campo', $album->campo) }}" --}}
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Título del Álbum</label>
                                    <input type="text" name="title" class="form-control @error('title') is-invalid @enderror"
                                           value="{{ old('title', $album->title) }}">
                                    @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Artista</label>
                                    <input type="text" name="artist" class="form-control @error('artist') is-invalid @enderror"
                                           value="{{ old('artist', $album->artist) }}">
                                    @error('artist') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Año de lanzamiento</label>
                                    <input type="number" name="release_year" class="form-control @error('release_year') is-invalid @enderror"
                                           value="{{ old('release_year', $album->release_year) }}">
                                    @error('release_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Formato Actual: {{ ucfirst($album->format) }}</label>
                                    <select name="format" class="form-select @error('format') is-invalid @enderror">
                                        <option value="vinyl" {{ old('format', $album->format) == 'vinyl' ? 'selected' : '' }}>Vinilo</option>
                                        <option value="cd" {{ old('format', $album->format) == 'cd' ? 'selected' : '' }}>CD</option>
                                        <option value="digital" {{ old('format', $album->format) == 'digital' ? 'selected' : '' }}>Digital</option>
                                    </select>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <label class="form-label fw-bold">Rating (1-5)</label>
                                    <input type="number" name="average_rating" class="form-control"
                                           value="{{ old('average_rating', $album->average_rating) }}">
                                </div>
                            </div>

                            {{-- 3. Permitir cambio de imagen (opcional) --}}
                            <div class="mb-4 mt-3 p-3 border rounded bg-white">
                                <label class="form-label fw-bold d-block">Imagen de Portada</label>
                                <div class="d-flex align-items-center gap-3">
                                    @if($album->cover_image)
                                        <img src="{{ $album->cover_image }}" alt="Actual" class="img-thumbnail" style="width: 80px;">
                                    @endif
                                    <div class="flex-grow-1">
                                        <input type="file" name="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                                        <small class="text-muted">Dejar vacío para mantener la imagen actual.</small>
                                    </div>
                                </div>
                                @error('cover_image') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="d-flex justify-content-between align-items-center mt-4">
                                <a href="{{ route('album.show', $album) }}" class="text-secondary text-decoration-none">← Cancelar y volver</a>
                                <button type="submit" class="btn btn-dark px-5 shadow">Actualizar Álbum</button>
                            </div>

                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>

</body>
</html>
