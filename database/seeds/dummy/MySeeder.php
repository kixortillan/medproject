<?php

use Illuminate\Database\Seeder;

class MySeeder extends Seeder {

    /**
     * 
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();
        $generator = new Faker\ORM\Doctrine\Populator($faker, app('em'));

        $generator->addEntity(\App\Libraries\Entities\Core\MedicalCase::class, 100, [
            'updatedAt' => null,
            'deletedAt' => null,
        ]);

        //$medicalCases = $generator->execute();

        //$generator = new Faker\ORM\Doctrine\Populator($faker, app('em'));

        $generator->addEntity(\App\Libraries\Entities\Core\Patient::class, 100, [
            'updatedAt' => null,
            'deletedAt' => null,
        ]);

        //$patients = $generator->execute();
        //$patients = array_pop($patients);
        //$maxPatients = count($patients);
        
        //$generator = new Faker\ORM\Doctrine\Populator($faker, app('em'));
        
        $generator->addEntity(\App\Libraries\Entities\Core\MedicalCasePatient::class, 100, [
            //'patientId' => $patients[mt_rand(0, $maxPatients - 1)]->getId(),
            'updatedAt' => null,
            'deletedAt' => null,
        ]);
        
        $assoc = $generator->execute();
        
        //dd($assoc);
    }

}
