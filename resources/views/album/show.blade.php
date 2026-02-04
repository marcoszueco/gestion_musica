<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $album->title }} - Detalle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">

<div class="container py-5">
    <a href="{{ route('album.index') }}" class="btn btn-link text-decoration-none mb-4">
        <i class="bi bi-arrow-left"></i> Volver al listado
    </a>

    <div class="row">
        {{-- 3. Mostrar imagen destacada --}}
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <img src="{{ $album->cover_image ?? 'https://via.placeholder.com/500' }}"
                     class="card-img-top img-fluid rounded"
                     alt="{{ $album->title }}">
            </div>
        </div>

        {{-- 2. Mostrar toda la información del ítem --}}
        <div class="col-md-7">
            <div class="ps-md-4">
                <h1 class="fw-bold mb-1">{{ $album->title }}</h1>
                <h3 class="text-muted mb-3">{{ $album->artist }}</h3>

                {{-- 4. Mostrar valoración promedio --}}
                <div class="mb-4">
                    <span class="badge bg-warning text-dark fs-5">
                        <i class="bi bi-star-fill"></i> {{ $album->average_rating ?? 'Sin calificación' }}
                    </span>
                    <span class="text-muted ms-2">Promedio de la comunidad</span>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold border-bottom pb-2">Información Técnica</h5>
                        <div class="row pt-2">
                            <div class="col-6 mb-2"><strong>Año:</strong> {{ $album->release_year }}</div>
                            <div class="col-6 mb-2"><strong>Formato:</strong> {{ ucfirst($album->format) }}</div>
                            <div class="col-6 mb-2"><strong>Género:</strong> {{ $album->genre ?? 'N/A' }}</div>
                            <div class="col-6 mb-2"><strong>Sello:</strong> {{ $album->label ?? 'N/A' }}</div>
                            <div class="col-6 mb-2"><strong>Canciones:</strong> {{ $album->track_count ?? 'N/A' }}</div>
                            <div class="col-6 mb-2"><strong>Duración:</strong> {{ $album->duration ? $album->duration . ' min' : 'N/A' }}</div>
                        </div>
                    </div>
                </div>

                {{-- 5. Mostrar botones editar/eliminar (solo creador o admin) --}}
                @auth
                    @if(Auth::id() === $album->user_id)
                        <div class="d-flex gap-2 mb-5">
                            <a href="{{ route('album.edit', $album) }}" class="btn btn-outline-primary px-4">
                                <i class="bi bi-pencil"></i> Editar Álbum
                            </a>

                            <form action="{{ route('album.destroy', $album) }}" method="POST" onsubmit="return confirm('¿Estás seguro de eliminar este álbum?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger">
                                    <i class="bi bi-trash"></i> Eliminar
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">
        {{-- 6. Sección de valoraciones --}}
        <div class="col-md-6 mb-4">
            <h4 class="fw-bold mb-4">Valoraciones</h4>
            <div class="list-group list-group-flush bg-white rounded shadow-sm p-3">
                <div class="list-group-item border-0">
                    <div class="text-warning mb-1">
                        <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star"></i>
                    </div>
                    <p class="mb-0 small text-muted italic">"Una obra maestra del género."</p>
                </div>
            </div>
        </div>

        {{-- 7. Sección de comentarios --}}
        <div class="col-md-6">
            <h4 class="fw-bold mb-4">Comentarios</h4>
            <div class="bg-white rounded shadow-sm p-4">
                {{-- Formulario de comentario rápido --}}
                @auth
                    <form class="mb-4">
                        <textarea class="form-control mb-2" rows="2" placeholder="Escribe tu opinión..."></textarea>
                        <button class="btn btn-sm btn-dark">Publicar comentario</button>
                    </form>
                @endauth

                <div class="d-flex mb-3">
                    <div class="flex-shrink-0">
                        <div class="bg-secondary text-white rounded-circle d-flex align-items-center justify-content-center" style="width: 40px; height: 40px;">U</div>
                    </div>
                    <div class="ms-3">
                        <h6 class="mb-0 fw-bold">Usuario Melómano</h6>
                        <p class="text-muted small">Este álbum cambió mi forma de ver la música.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
