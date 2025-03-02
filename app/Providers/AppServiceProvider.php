<?php
namespace App\Providers;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\ORMSetup;
use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\EntityManager;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        // Configuración usando ORMSetup
        $config = ORMSetup::createAttributeMetadataConfiguration(
            [app_path('Entities')], // Ruta donde están tus entidades
            env('APP_DEBUG', false)
        );
        
        // Configuración de la conexión
        $connectionParams = [
            'dbname' => env('DB_DATABASE'),
            'user' => env('DB_USERNAME'),
            'password' => env('DB_PASSWORD'),
            'host' => env('DB_HOST'),
            'driver' => 'pdo_mysql',
            'charset'  => 'utf8mb4',
        ];
        
        // Primero crear la conexión
        $connection = DriverManager::getConnection($connectionParams);
        
        // Luego crear el EntityManager usando la nueva sintaxis
        $entityManager = new EntityManager($connection, $config);
        
        // Registrar en el contenedor de Laravel
        $this->app->singleton(EntityManagerInterface::class, function ($app) use ($entityManager) {
            return $entityManager;
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
         Schema::defaultStringLength(191);
    }
}