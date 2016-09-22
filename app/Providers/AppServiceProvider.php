<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider {

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register() {
        $this->app->when(\App\Libraries\Repositories\Core\Doctrine\DepartmentRepository::class)
                ->needs(\Doctrine\ORM\EntityManager::class)
                ->give(function() {
                    return app('registry')->getManagerForClass(\App\Libraries\Entities\Core\Department::class);
                });
    }

}
