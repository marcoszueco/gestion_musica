<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
    <div class="container py-5">
        
        <div class="d-flex justify-content-between align-items-center mb-5">
            <div>
                <h1 class="display-5 fw-bold text-dark fst-comic">🎵 Mi Colección de Álbumes</h1>
                <p class="text-muted">Gestiona y explora tus álbumes favoritos</p>
            </div>



            <?php if(auth()->guard()->check()): ?>
                <?php if(auth()->user()->isAdmin()): ?>
                    <a href="<?php echo e(route('album.create')); ?>" class="btn btn-primary btn-lg shadow-sm px-4">
                        <i class="bi bi-plus-lg"></i> Crear Nuevo
                    </a>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        
        <div class="row g-4">
            <?php $__empty_1 = true; $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <div class="col-12 col-sm-6 col-lg-4">
                    <div class="card h-100 border-0 shadow-sm hover-shadow transition">
                        
                        <div class="bg-light d-flex align-items-center justify-content-center" style="height: 280px; overflow: hidden;">
                            <img src="<?php echo e($album->cover_image ?? 'https://via.placeholder.com/300'); ?>"
                                 class="card-img-top p-3"
                                 style="max-height: 100%; width: auto; object-fit: contain;"
                                 alt="<?php echo e($album->title); ?>">
                        </div>

                        <div class="card-body d-flex flex-column">
                            <div class="mb-2">
                                <span class="badge bg-warning text-dark mb-2">
                                    ⭐ <?php echo e($album->average_rating ?? 'N/A'); ?>

                                </span>
                                <span class="badge bg-light text-secondary border float-end"><?php echo e($album->format); ?></span>
                            </div>

                            <h5 class="card-title fw-bold text-dark mb-1 text-truncate"><?php echo e($album->title); ?></h5>
                            <p class="text-muted small mb-4">
                                <i class="bi bi-person-circle"></i> <?php echo e($album->artist); ?>

                            </p>

                            <div class="mt-auto">
                                <a href="<?php echo e(route('album.show', $album)); ?>" class="btn btn-outline-dark btn-sm w-100 mt-3">
                                    Ver detalles
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="col-12 text-center py-5">
                    <div class="display-1 text-muted opacity-25 mb-3">💿</div>
                    <p class="lead text-muted">No hay álbumes en la lista todavía.</p>
                </div>
            <?php endif; ?>
        </div>

        
        <div class="d-flex justify-content-center mt-5">
            <?php echo e($albums->links()); ?>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php /**PATH /var/www/html/gestion_musica/resources/views/album/index.blade.php ENDPATH**/ ?>