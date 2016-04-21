<?php

use Illuminate\Database\Seeder;

class DepartmentSeeder extends Seeder {

    /**
     * 
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        $insertValues = [];
        for ($i = 0; $i < 100000; $i++) {
            $insertValues[] = [
                'code' => $faker->word,
                'name' => $faker->word,
                'desc' => $faker->sentence(),
                'created_at' => $faker->dateTimeThisDecade
            ];

            if (count($insertValues) > 10000) {
                DB::table('departments')
                        ->insert($insertValues);
                $insertValues = [];
            }
        }
    }

}
