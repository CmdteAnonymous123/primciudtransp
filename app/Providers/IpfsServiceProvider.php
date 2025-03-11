<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Cloutier\PhpIpfsApi\IPFS;

class IpfsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('ipfs', function ($app) {
            return new IPFS(
                env('IPFS_HOST', 'localhost'),
                env('IPFS_PORT', 5001),
                env('IPFS_API', '/api/v0/')
            );
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
