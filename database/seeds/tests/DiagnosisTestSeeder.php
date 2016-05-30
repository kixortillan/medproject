<?php

use Illuminate\Database\Seeder;

class DiagnosisTestSeeder extends Seeder {

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
                'name' => $faker->word,
                'desc' => $faker->sentence,
                'created_at' => $faker->dateTimeThisDecade
            ];

            if (count($insertValues) > 100) {
                DB::table('diagnoses')
                        ->insert($insertValues);
                unset($insertValues);
            }
        }
    }

}
