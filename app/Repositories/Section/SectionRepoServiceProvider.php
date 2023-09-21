<?php

namespace App\Repositories\Section;

use Carbon\Laravel\ServiceProvider;

/**
 *
 */
class SectionRepoServiceProvider extends ServiceProvider
{

    /**
     * @return void
     */
    public function boot()
    {

    }

    /**
     * @return void
     */
    public function register(): void
    {
        $this->app->bind(\App\Repositories\Section\SectionInterface::class, \App\Repositories\Section\SectionRepository::class );
    }

}
