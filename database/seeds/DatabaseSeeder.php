<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call('UserTableSeeder');
        $this->call(DepartmentSeeder::class);
        //$this->call(PatientSeeder::class);
        //$this->call(DiagnosisSeeder::class);
        //$this->call(MedicalCaseSeeder::class);
    }
}
