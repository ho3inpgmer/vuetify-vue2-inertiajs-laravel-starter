<?php

namespace App\Table;

use Illuminate\Support\ServiceProvider;
use Inertia\Response;

class TableServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Response::macro('table', function () {

            $tableBuilder = new Table(request());

            return $tableBuilder->applyTo($this);

        });
    }
}
