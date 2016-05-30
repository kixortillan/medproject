<?php

use Illuminate\Database\Seeder;

class PatientTestSeeder extends Seeder {

    /**
     * 
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        $insertValues = [];
        for ($i = 0; $i < 100; $i++) {
            $insertValues[] = [
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'postal_code' => $faker->postcode,
                'created_at' => $faker->dateTimeThisDecade
            ];

            if (count($insertValues) > 100) {
                DB::table('patients')
                        ->insert($insertValues);
                $insertValues = [];
            }
        }
    }

}
