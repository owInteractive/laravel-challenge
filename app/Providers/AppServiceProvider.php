<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        \Illuminate\Support\Facades\Schema::defaultStringLength(191); ///PARA PERMITIR UM TAMANHO MAIOR DE STRING
        \Illuminate\Pagination\AbstractPaginator::defaultView("pagination::bootstrap-4");
        \Illuminate\Pagination\AbstractPaginator::defaultSimpleView("pagination::simple-bootstrap-4");

    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
