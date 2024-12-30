<?php

namespace App\Providers;

use App\Services\UserService;
use App\Services\impl\UserServiceImpl;
use Illuminate\Contracts\Support\DeferrableProvider;
use Illuminate\Support\ServiceProvider;
use Illuminate\Filesystem\Filesystem;

class userServiceProvider extends ServiceProvider implements DeferrableProvider
{

    public array $singletons = [
        UserService::class => UserServiceImpl::class
    ];



    public function provides(): array
    {
        return [UserService::class];
    }
    /**
     * Register services.
     */
    public function register()
    {
        
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
