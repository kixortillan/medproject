<?php

use Illuminate\Database\Seeder;

class PatientSeeder extends Seeder {

    /**
     * 
     *
     * @return void
     */
    public function run() {
        /*$faker = Faker\Factory::create();

        $insertValues = [];
        for ($i = 0; $i < 1000000; $i++) {
            $insertValues[] = [
                'first_name' => $faker->firstName,
                'middle_name' => $faker->lastName,
                'last_name' => $faker->lastName,
                'address' => $faker->address,
                'postal_code' => $faker->postcode,
                'created_at' => $faker->dateTimeThisDecade
            ];

            if (count($insertValues) > 10000) {
                DB::table('patients')
                        ->insert($insertValues);
                $insertValues = [];
            }
        }*/
        
        entity(\App\Libraries\Entities\Core\Patient::class, 50000)->create();
    }

}
