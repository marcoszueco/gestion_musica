<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Añadir Nuevo Álbum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-primary text-white py-3">
                    <h4 class="mb-0">Añadir Nuevo Álbum a la Colección</h4>
                </div>
                <div class="card-body p-4">

                    {{-- 2. Formulario con todos los campos --}}
                    {{-- 4. Implementar campo de subida de imagen (enctype es vital) --}}
                    <form action="{{ route('album.store') }}" method="POST" enctype="multipart/form-data">

                        {{-- 3. Protección CSRF --}}
                        @csrf

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="title" class="form-label font-weight-bold">Título del Álbum</label>
                                <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}">
                                @error('title') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label for="artist" class="form-label">Artista / Banda</label>
                                <input type="text" name="artist" id="artist" class="form-control @error('artist') is-invalid @enderror" value="{{ old('artist') }}">
                                @error('artist') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="release_year" class="form-label">Año</label>
                                <input type="number" name="release_year" id="release_year" class="form-control @error('release_year') is-invalid @enderror" value="{{ old('release_year') }}">
                                @error('release_year') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="format" class="form-label">Formato</label>
                                <select name="format" id="format" class="form-select @error('format') is-invalid @enderror">
                                    <option value="">Seleccionar...</option>
                                    <option value="vinyl" {{ old('format') == 'vinyl' ? 'selected' : '' }}>Vinilo</option>
                                    <option value="cd" {{ old('format') == 'cd' ? 'selected' : '' }}>CD</option>
                                    <option value="digital" {{ old('format') == 'digital' ? 'selected' : '' }}>Digital</option>
                                </select>
                                @error('format') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>

                            <div class="col-md-4 mb-3">
                                <label for="average_rating" class="form-label">Rating (1-5)</label>
                                <input type="number" name="average_rating" id="average_rating" class="form-control @error('average_rating') is-invalid @enderror" value="{{ old('average_rating') }}">
                                @error('average_rating') <div class="invalid-feedback">{{ $message }}</div> @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="genre" class="form-label">Género</label>
                                <input type="text" name="genre" id="genre" class="form-control" value="{{ old('genre') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="label" class="form-label">Sello Discográfico</label>
                                <input type="text" name="label" id="label" class="form-control" value="{{ old('label') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="cover_image" class="form-label">Imagen de Portada</label>
                            <input type="file" name="cover_image" id="cover_image" class="form-control @error('cover_image') is-invalid @enderror">
                            <small class="text-muted">Formatos permitidos: JPG, PNG. Máx 2MB.</small>
                            @error('cover_image') <div class="invalid-feedback">{{ $message }}</div> @enderror
                        </div>

                        <hr class="my-4">

                        <div class="d-flex justify-content-between">
                            <a href="{{ route('album.index') }}" class="btn btn-light text-secondary">Cancelar</a>
                            <button type="submit" class="btn btn-primary px-5">Guardar Álbum</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
