<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e($album->title); ?> - Detalle</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.0/font/bootstrap-icons.css">
</head>
<body class="bg-light">
<div class="container py-5">
    <a href="<?php echo e(route('album.index')); ?>" class="btn btn-link text-decoration-none mb-4">
        <i class="bi bi-arrow-left"></i> Volver al listado
    </a>

    <div class="row">
        
        <div class="col-md-5 mb-4">
            <div class="card shadow-sm border-0">
                <img src="<?php echo e($album->cover_image ?? 'https://via.placeholder.com/500'); ?>"
                     class="card-img-top img-fluid rounded"
                     alt="<?php echo e($album->title); ?>">
            </div>
        </div>

        
        <div class="col-md-7">
            <div class="ps-md-4">
                <h1 class="fw-bold mb-1"><?php echo e($album->title); ?></h1>
                <h3 class="text-muted mb-3"><?php echo e($album->artist); ?></h3>

                
                <div class="mb-4">
                    <span class="badge bg-warning text-dark fs-5">
                        <i class="bi bi-star-fill"></i> <?php echo e($album->average_rating ?? 'Sin calificación'); ?>

                    </span>
                    <span class="text-muted ms-2">Promedio de la comunidad</span>
                </div>

                <div class="card border-0 shadow-sm mb-4">
                    <div class="card-body">
                        <h5 class="fw-bold border-bottom pb-2">Información Técnica</h5>
                        <div class="row pt-2">
                            <div class="col-6 mb-2"><strong>Año:</strong> <?php echo e($album->release_year); ?></div>
                            <div class="col-6 mb-2"><strong>Formato:</strong> <?php echo e(ucfirst($album->format)); ?></div>
                            <div class="col-6 mb-2"><strong>Género:</strong> <?php echo e($album->genre ?? 'N/A'); ?></div>
                            <div class="col-6 mb-2"><strong>Sello:</strong> <?php echo e($album->label ?? 'N/A'); ?></div>
                            <div class="col-6 mb-2"><strong>Canciones:</strong> <?php echo e($album->track_count ?? 'N/A'); ?></div>
                            <div class="col-6 mb-2"><strong>Duración:</strong> <?php echo e($album->duration ? $album->duration . ' min' : 'N/A'); ?></div>
                        </div>
                    </div>
                </div>

                
                <?php if(auth()->guard()->check()): ?>
                    <?php if(auth()->user()->isAdmin()): ?>
                        <div class="d-flex gap-2 mb-5">
                            <a href="<?php echo e(route('album.edit', $album)); ?>" class="btn btn-outline-primary px-4">
                                <i class="bi bi-pencil"></i> Editar Álbum
                            </a>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        </div>
        <div class="flex flex-col items-center p-4 bg-gray-50 rounded-xl border">
            <h4 class="mb-2 text-sm font-semibold text-muted text-uppercase">Tu Valoración</h4>
            
            <form action="<?php echo e(route('rating.store')); ?>" method="POST" id="rating-form" class="d-flex flex-row-reverse justify-content-center">
                <?php echo csrf_field(); ?>
                
                <input type="hidden" name="album_id" value="<?php echo e($album->id); ?>">

                <?php
                    // Buscamos el voto del usuario actual
                    $userRating = $album->ratings->where('user_id', auth()->id())->first()?->score;
                ?>

                <?php for($i = 5; $i >= 1; $i--): ?>
                    <input type="radio" id="star<?php echo e($i); ?>" name="score" value="<?php echo e($i); ?>"
                           class="btn-check" 
                           onchange="this.form.submit()"
                        <?php echo e($userRating == $i ? 'checked' : ''); ?>>

                    <label for="star<?php echo e($i); ?>" class="cursor-pointer fs-2 px-1 text-secondary transition">
                        <i class="bi <?php echo e($userRating >= $i ? 'bi-star-fill text-warning' : 'bi-star'); ?>"></i>
                    </label>
                <?php endfor; ?>
            </form>

            <?php if($userRating): ?>
                <p class="mt-2 small text-warning fw-bold">
                    Has puntuado con <?php echo e($userRating); ?> estrellas
                </p>
            <?php endif; ?>
        </div>
    </div>

    <hr class="my-5">

    <div class="row">

        
        <div class="col-md-6">
            <h4 class="fw-bold mb-4">Reseñas de la Comunidad</h4>
            <div class="bg-white rounded shadow-sm p-4">

                
                <?php if(auth()->guard()->check()): ?>
                    <form action="<?php echo e(route('review.store')); ?>" method="POST" class="mb-4 border-bottom pb-4">
                        <?php echo csrf_field(); ?>
                        <input type="hidden" name="album_id" value="<?php echo e($album->id); ?>">

                        <div class="mb-2">
                            <input type="text" name="title" class="form-control form-control-sm mb-2" placeholder="Título de tu reseña" required>
                            <textarea name="content" class="form-control mb-2" rows="3" placeholder="¿Qué te ha parecido este álbum?" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-sm btn-dark">Publicar reseña</button>
                    </form>
                <?php else: ?>
                    <p class="small text-muted text-center">Debes iniciar sesión para escribir una reseña.</p>
                <?php endif; ?>

                
                <div class="reviews-list" style="max-height: 400px; overflow-y: auto;">
                    
                    <?php $__empty_1 = true; $__currentLoopData = $album->reviews; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $review): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                        <div class="mb-4 p-3 bg-light rounded">
                            <h6><?php echo e($review->title); ?></h6>
                            <p class="small mb-1"><?php echo e($review->content); ?></p>
                            <small class="text-muted">Por <?php echo e($review->user->name); ?></small>

                            
                            <?php if(auth()->guard()->check()): ?>
                                <?php if(auth()->user()->isAdmin() || auth()->id() === $review->user_id): ?>
                                    <form action="<?php echo e(route('review.destroy', $review)); ?>" method="POST" class="d-inline">
                                        <?php echo csrf_field(); ?>
                                        <?php echo method_field('DELETE'); ?>
                                        <button type="submit" class="btn btn-sm text-danger">
                                            <i class="bi bi-trash"></i> Eliminar
                                        </button>
                                    </form>
                                <?php endif; ?>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                        <p>No hay reseñas todavía.</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
<?php /**PATH /var/www/html/gestion_musica/resources/views/album/show.blade.php ENDPATH**/ ?>