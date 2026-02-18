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
     <?php $__env->slot('header', null, []); ?> 
        <h2 class="font-semibold text-xl text-gray-800 dark:text-amber-200 leading-tight">
            <?php echo e(__('Perfil de Melómano')); ?>

        </h2>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">

            <div class="p-4 sm:p-8 bg-lime-600 dark:bg-blue-600 shadow sm:rounded-lg border-l-4 border-indigo-500">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="h-20 w-20 rounded-full bg-indigo-100 flex items-center justify-center">
                            <i class="bi bi-person-badge text-4xl text-indigo-600"></i>
                        </div>
                    </div>
                    <div class="ml-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100"><?php echo e($user->name); ?></h3>
                        <p class="text-gray-600 dark:text-gray-400"><?php echo e($user->email); ?></p>
                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-purple-100 text-purple-800 mt-2 capitalize">
                            Rol: <?php echo e($user->role); ?>

                        </span>
                    </div>
                </div>
                <?php if (isset($component)) { $__componentOriginalc295f12dca9d42f28a259237a5724830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc295f12dca9d42f28a259237a5724830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.nav-link','data' => ['class' => 'font-semibold','href' => route('profile.edit'),'active' => request()->routeIs('profile.edit')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav-link'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['class' => 'font-semibold','href' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('profile.edit')),'active' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(request()->routeIs('profile.edit'))]); ?>
                    <?php echo e(__('Editar Perfil')); ?>

                 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $attributes = $__attributesOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__attributesOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc295f12dca9d42f28a259237a5724830)): ?>
<?php $component = $__componentOriginalc295f12dca9d42f28a259237a5724830; ?>
<?php unset($__componentOriginalc295f12dca9d42f28a259237a5724830); ?>
<?php endif; ?>
            </div>

            <div class="p-4 sm:p-8 bg-lime-600 dark:bg-blue-600 shadow sm:rounded-lg">
                <header class="mb-6 flex justify-between items-center">
                    <div>
                        <h2 class="text-lg font-medium text-gray-900 dark:text-gray-100">
                            <i class="bi bi-disc text-indigo-500 mr-2"></i><?php echo e(__('Mi Colección Musical')); ?>

                        </h2>
                        <p class="mt-1 text-sm text-gray-600 dark:text-gray-400">
                            Explora los álbumes que has aportado a la comunidad.
                        </p>
                    </div>
                    <?php if($albums->count() == 0): ?>
                        <span class="bg-indigo-800 text-red-600 text-xs font-bold px-3 py-1 rounded-full">
                            <?php echo e($albums->count()); ?> Álbumes
                        </span>
                    <?php else: ?>
                        <span class="bg-indigo-800 text-green-600 text-xs font-bold px-3 py-1 rounded-full">
                            <?php echo e($albums->count()); ?> Álbumes
                        </span>
                    <?php endif; ?>

                </header>

                <?php if($albums->isEmpty()): ?>
                    <div class="text-center py-10 border-2 border-dashed border-gray-300 dark:border-gray-700 rounded-xl">
                        <i class="bi bi-music-note-beamed text-4xl text-gray-400"></i>
                        <p class="mt-2 text-gray-500 italic font-mono">Parece que tu estantería está vacía...</p>
                        <a href="<?php echo e(route('dashboard')); ?>" class="mt-4 inline-block text-indigo-500 hover:underline">¡Empieza a coleccionar!</a>
                    </div>
                <?php else: ?>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                        <?php $__currentLoopData = $albums; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $album): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="bg-gray-50 dark:bg-gray-700 p-4 rounded-xl border border-gray-200 dark:border-gray-600 hover:shadow-md transition">
                                <h4 class="font-bold text-gray-900 dark:text-white truncate"><?php echo e($album->title); ?></h4>
                                <p class="text-indigo-400 text-sm"><?php echo e($album->artist); ?></p>
                                <div class="mt-3 flex justify-between items-center text-xs text-gray-500">
                                    <span><?php echo e($album->genre); ?></span>
                                    <span><?php echo e($album->release_year); ?></span>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>

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
<?php /**PATH /var/www/html/gestion_musica/resources/views/profile/show.blade.php ENDPATH**/ ?>