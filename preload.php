<?php
// preload.php
opcache_compile_file(__DIR__ . '/vendor/autoload.php');
// Preload framework core
$framework_files = [
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
