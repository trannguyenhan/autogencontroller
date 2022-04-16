<?php

namespace Trannguyenhan\AutogenController;

use Illuminate\Support\ServiceProvider;

class AutogenControllerProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->commands([
            \Trannguyenhan\AutogenController\AutogenControllerCommand::class,
        ]);
    }
}
