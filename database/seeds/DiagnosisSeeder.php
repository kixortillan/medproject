<?php

use Illuminate\Database\Seeder;

class DiagnosisSeeder extends Seeder {

    /**
     * 
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        $insertValues = [];
        for ($i = 0; $i < 500000; $i++) {
            $insertValues[] = [
                'name' => $faker->word,
                'desc' => $faker->sentence,
                'created_at' => $faker->dateTimeThisDecade
            ];

            if (count($insertValues) > 10000) {
                DB::table('diagnoses')
                        ->insert($insertValues);
                unset($insertValues);
            }
        }
    }

}
