<?php

namespace Tests;

use Illuminate\Contracts\Console\Kernel;
use Illuminate\Foundation\Application;

trait CreatesApplication
{
    /**
     * Creates the application.
     */
    public function createApplication(): Application
    {
        $app = require __DIR__.'/../bootstrap/app.php';
        try {
            $app->make(Kernel::class)->bootstrap();
        }
        catch (\Throwable $throwable) {
            var_dump($throwable->getMessage());die;
        }

        return $app;
    }
}
