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

//        $insertValues = [];
//        for ($i = 0; $i < 1000000; $i++) {
//            $insertValues[] = [
//                'serial_num' => sprintf("MCN-%s%s", strtotime('now'), mt_rand(10000, 99999)),
//                'created_at' => $faker->dateTimeThisDecade
//            ];
//
//            if (count($insertValues) > 10000) {
//                DB::table('medical_cases')
//                        ->insert($insertValues);
//                $insertValues = [];
//            }
//        }
//
//        //seed departments of medical case
//        DB::table('medical_cases')
//                ->chunk(10000, function($medicalCases) use($faker) {
//                    $insertData = [];
//                    foreach ($medicalCases as $md) {
//                        $depts = DB::table('departments')
//                                ->whereBetween('created_at', [$faker->dateTimeThisDecade, $faker->dateTimeThisDecade])
//                                ->limit(mt_rand(3, 7))
//                                ->get();
//                        
//                        foreach ($depts as $dept) {
//                            $insertData[] = [
//                                'medical_case_id' => $md->id,
//                                'department_id' => $dept->id,
//                            ];
//                        }
//                    }
//                    DB::table('medical_case_departments')
//                            ->insert($insertData);
//                    unset($insertData);
//                });
        //seed diagnoses of medical case
        DB::table('medical_cases')
                ->chunk(1000, function($medicalCases) use($faker) {
                    $insertData = [];
                    foreach ($medicalCases as $md) {
                        $diagnoses = DB::table('diagnoses')
                                ->whereBetween('created_at', [$faker->dateTimeThisDecade, $faker->dateTimeThisDecade])
                                ->limit(mt_rand(3, 7))
                                ->get();

                        foreach ($diagnoses as $dg) {
                            $insertData[] = [
                                'medical_case_id' => $md->id,
                                'diagnosis_id' => $dg->id,
                            ];
                            DB::table('medical_case_diagnoses')
                                ->insert($insertData);
                            unset($insertData);
                        }
                    }
                });

        /* DB::table('patients')
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
          }); */
    }

}
