<?php

use Illuminate\Database\Seeder;

class MedicalCaseSeeder extends Seeder {

    /**
     * 
     *
     * @return void
     */
    public function run() {
        $faker = Faker\Factory::create();

        $insertValues = [];
        for ($i = 0; $i < 1000000; $i++) {
            $insertValues[] = [
                'serial_num' => sprintf("MCN-%s%s", strtotime('now'), mt_rand(10000, 99999)),
                'created_at' => $faker->dateTimeThisDecade
            ];

            if (count($insertValues) > 10000) {
                DB::table('medical_cases')
                        ->insert($insertValues);
                $insertValues = [];
            }
        }

        //seed departments of medical case
        DB::table('medical_cases')
                ->chunk(100, function($medicalCases) use($faker) {
                    foreach ($medicalCases as $md) {
                        $depts = DB::table('departments')
                                ->whereBetween('created_at', [$faker->dateTimeThisDecade, $faker->dateTimeThisDecade])
                                ->get();
                        foreach ($depts as $dept) {
                            DB::table('medical_case_departments')
                            ->insert([
                                'medical_case_id' => $md->id,
                                'department_id' => $dept->id,
                            ]);
                        }
                    }
                });

        //seed diagnoses of medical case
        DB::table('medical_cases')
                ->chunk(100, function($medicalCases) {
                    foreach ($medicalCases as $md) {
                        $depts = DB::table('diagnoses')
                                ->whereBetween('created_at', [$faker->dateTimeThisDecade, $faker->dateTimeThisDecade])
                                ->get();
                        foreach ($diagnoses as $dg) {
                            DB::table('medical_case_departments')
                            ->insert([
                                'medical_case_id' => $md->id,
                                'diagnosis' => $dg->id,
                            ]);
                        }
                    }
                });

        /*DB::table('patients')
                ->chunk(100, function($patients) {
                    foreach ($patients as $patient) {
                        DB::table('departments')
                        ->chunk(100, function ($departments) use($patient) {
                            foreach ($departments as $dept) {
                                DB::table('diagnoses')
                                ->chunk(100, function ($diagnoses) use ($dept) {
                                    foreach ($diagnoses as $diag) {
                                        
                                    }
                                });
                            }
                        });
                    }
                });*/
    }

}
