<?php
// preload.php
opcache_compile_file(__DIR__ . '/vendor/autoload.php');
// Preload framework core
$framework_files = [
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Conditionable/Traits/Conditionable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Traits/InteractsWithData.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Traits/Dumpable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Http/Concerns/InteractsWithInput.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Http/Concerns/InteractsWithFlashData.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Http/Concerns/InteractsWithContentTypes.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Http/Concerns/CanBePrecognitive.php',
    __DIR__ . '/vendor/symfony/http-foundation/Request.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Http/Request.php',

    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/HasCollection.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Traits/ForwardsCalls.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/TransformsToResource.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/PreventsCircularRecursion.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/GuardsAttributes.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HidesAttributes.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HasUniqueIds.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HasTimestamps.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HasRelationships.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HasGlobalScopes.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HasEvents.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Concerns/HasAttributes.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Routing/UrlRoutable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Queue/QueueableEntity.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Support/Jsonable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Broadcasting/HasBroadcastChannel.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Support/CanBeEscapedWhenCastToString.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Support/Arrayable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Database/Eloquent/Model.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Traits/Tappable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Routing/Registrar.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Routing/BindingRegistrar.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Routing/Router.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Support/Renderable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/View/View.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Support/Htmlable.php',
     __DIR__ . '/vendor/laravel/framework/src/Illuminate/View/View.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Collection.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Arr.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Str.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/Facades/Facade.php',

    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Macroable/Traits/Macroable.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Container/Container.php',
    __DIR__ . '/vendor/symfony/http-kernel/HttpKernelInterface.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Foundation/CachesRoutes.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Foundation/CachesConfiguration.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Contracts/Foundation/Application.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Foundation/Application.php',
    __DIR__ . '/vendor/psr/container/src/ContainerInterface.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Container/Container.php',
    __DIR__ . '/vendor/laravel/framework/src/Illuminate/Support/ServiceProvider.php',
    __DIR__ . '/app/Providers/AppServiceProvider.php',
    
];

foreach ($framework_files as $file) {
    if (file_exists($file)) {
        opcache_compile_file($file);
    }
}
