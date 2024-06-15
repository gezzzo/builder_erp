<?php

declare(strict_types=1);

use App\Http\Controllers\API\Dashboard\Tenants\BuildingController;
use App\Http\Controllers\API\Dashboard\Tenants\ClientsController;
use App\Http\Controllers\API\Dashboard\Tenants\CompanyController;
use App\Http\Controllers\API\Dashboard\Tenants\GranteeController;
use App\Http\Controllers\API\Dashboard\Tenants\ProjectController;
use App\Http\Controllers\API\Dashboard\Tenants\UnitController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'api',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/home', function () {
        return 'This is your multi-tenant application. The id of the current tenant is ' . tenant('id') . '.' . env('APP_DOMAIN');
    });

    // Client routes
    Route::apiResource('clients', ClientsController::class);
    Route::get('clients/search', [ClientsController::class, 'search'])->name('clients.search');

    // Company routes
    Route::apiResource('companies', CompanyController::class);
    Route::get('companies/search', [CompanyController::class, 'search'])->name('companies.search');

    // Grantee routes
    Route::apiResource('grantees', GranteeController::class);
    Route::get('grantees/search', [GranteeController::class, 'search'])->name('grantees.search');

    // Project routes
    Route::apiResource('projects', ProjectController::class);
    Route::get('projects/search', [ProjectController::class, 'search'])->name('projects.search');

    // Building routes
    Route::apiResource('buildings', BuildingController::class);
    Route::get('buildings/search', [BuildingController::class, 'search'])->name('buildings.search');

    // Unit routes
    Route::apiResource('units', UnitController::class);
    Route::get('units/search', [UnitController::class, 'search'])->name('units.search');
});
