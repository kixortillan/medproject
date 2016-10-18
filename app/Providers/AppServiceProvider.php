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

        $this->app->bind(\App\Libraries\Services\Core\Contracts\InterfaceDepartmentService::class, \App\Libraries\Services\Core\DepartmentService::class);
       
        $this->app->bind(\App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository::class, \App\Libraries\Repositories\Core\Doctrine\DepartmentRepository::class);
        $this->app->bind(\App\Libraries\Repositories\Core\Contracts\InterfacePatientRepository::class, \App\Libraries\Repositories\Core\Doctrine\PatientRepository::class);
        $this->app->bind(\App\Libraries\Repositories\Core\Contracts\InterfaceMedicalCaseRepository::class, \App\Libraries\Repositories\Core\Doctrine\MedicalCaseRepository::class);
    }

}
