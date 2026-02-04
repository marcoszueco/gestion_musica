<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mi Discografía</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container py-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="fw-bold text-dark">🎵 Mi Colección de Álbumes</h1>

        {{-- 6. Enlace "Crear nuevo" (solo si está autenticado) --}}
        @auth
            <a href="{{ route('album.create') }}" class="btn btn-primary shadow-sm">
                + Crear Nuevo
            </a>
        @endauth
    </div>

    <div class="row">
        {{-- 5. Mensaje si no hay contenido --}}
        @forelse($albums as $album)
            <div class="col-md-4 mb-4">
                {{-- 3. Tarjeta con imagen, título y rating --}}
                <div class="card h-100 shadow-sm border-0">
                    <img src="{{ $album->cover_image ?? 'https://via.placeholder.com/300' }}"
                         class="card-img p-3"
                         style="height: 250px; object-fit: contain;"
                         alt="{{ $album->title }}">

                    <div class="card-body">
                        <h5 class="card-title text-truncate">{{ $album->title }}</h5>
                        <p class="text-muted small mb-2">Artista: {{ $album->artist }}</p>

                        <div class="d-flex justify-content-between align-items-center">
                                <span class="badge bg-warning text-dark">
                                    ⭐ {{ $album->average_rating ?? 'N/A' }}
                                </span>
                            <span class="text-secondary small">{{ $album->format }}</span>
                        </div>

                        {{-- 4. Botón "Ver más" --}}
                        <a href="{{ route('album.show', $album) }}" class="btn btn-outline-dark btn-sm w-100 mt-3">
                            Ver más
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <p class="lead text-muted">No hay álbumes en la lista.</p>
            </div>
        @endforelse
    </div>

    {{-- 2. Paginación (15 ítems) --}}
    <div class="d-flex justify-content-center mt-4">
        {{ $albums->links() }}
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
