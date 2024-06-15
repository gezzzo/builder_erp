<?php

namespace App\Providers;

use App\Repositories\BuildingRepository;
use App\Repositories\ClientRepository;
use App\Repositories\CompanyRepository;
use App\Repositories\GranteeRepository;
use App\Repositories\Interfaces\BuildingInterface;
use App\Repositories\Interfaces\ClientInterface;
use App\Repositories\Interfaces\CompanyInterface;
use App\Repositories\Interfaces\GranteeInterface;
use App\Repositories\Interfaces\ProjectInterface;
use App\Repositories\Interfaces\UnitInterface;
use App\Repositories\Interfaces\UserInterface;
use App\Repositories\ProjectRepository;
use App\Repositories\UnitRepository;
use App\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class InterfaceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(UserInterface::class, UserRepository::class);
        $this->app->bind(ClientInterface::class, ClientRepository::class);
        $this->app->bind(CompanyInterface::class, CompanyRepository::class);
        $this->app->bind(GranteeInterface::class, GranteeRepository::class);
        $this->app->bind(ProjectInterface::class, ProjectRepository::class);
        $this->app->bind(BuildingInterface::class, BuildingRepository::class);
        $this->app->bind(UnitInterface::class, UnitRepository::class);
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
