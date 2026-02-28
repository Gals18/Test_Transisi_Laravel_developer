<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
   /**
    * Register any application services.
    */
   public function register(): void
   {
      $this->app->bind(
         \App\Repositories\Contracts\CompanyRepositoryInterface::class,
         \App\Repositories\Eloquent\CompanyRepository::class,
         \App\Repositories\Contracts\EmployeesRepositoryInterface::class,
         \App\Repositories\Eloquent\EmployeesRepository::class,
         \Barryvdh\Snappy\ServiceProvider::class,
      );
   }

   /**
    * Bootstrap any application services.
    */
   public function boot(): void
   {
      Paginator::useBootstrapFive();
   }
}
