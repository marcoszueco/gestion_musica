<x-app-layout>
    <div class="container py-5">
        {{-- Cabecera con diseño limpio --}}
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="display-5 fw-bold text-dark fst-comic">🎵 Mi Colección de Álbumes</h1>
                <p class="text-muted">Gestiona y explora tus álbumes favoritos</p>
            </div>



            @auth
                @if(auth()->user()->isAdmin())
                    <a href="{{ route('album.create') }}" class="btn btn-primary btn-lg shadow-sm px-4">
                        <i class="bi bi-plus-lg"></i> Crear Nuevo
                    </a>
                @endif
            @endauth
        </div>

        {{-- Grid de Álbumes --}}
        <div class="row g-4">
            @forelse($albums as $album)
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                        {{-- Contenedor de Imagen con ratio fijo --}}
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 280px; overflow: hidden;">
                            <img src="{{ $album->cover_image ?? 'https://via.placeholder.com/300' }}"
                                 class="card-img-top p-3"
                                 style="max-height: 100%; width: auto; object-fit: contain;"
                                 alt="{{ $album->title }}">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark mb-2">
                                    ⭐ {{ $album->average_rating ?? 'N/A' }}
                                </span>
                                <span class="badge bg-light text-secondary border float-end">{{ $album->format }}</span>
                            </div>

                            <h5 class="card-title fw-bold text-dark mb-1 text-truncate">{{ $album->title }}</h5>
                            <p class="text-muted small mb-4">
                                <i class="bi bi-person-circle"></i> {{ $album->artist }}
                            </p>

                            <div class="mt-auto">
                                <a href="{{ route('album.show', $album) }}" class="btn btn-outline-dark btn-sm w-100 mt-3">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="display-1 text-muted opacity-25 mb-3">💿</div>
                    <p class="lead text-muted">No hay álbumes en la lista todavía.</p>
                </div>
            @endforelse
        </div>

        {{-- Paginación --}}
        <div class="d-flex justify-content-center mt-5">
            {{ $albums->links() }}
        </div>
    </div>
</x-app-layout>
