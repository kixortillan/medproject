<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class PatientControllerTest extends TestCase {

    use DatabaseMigrations;

    public function testStore() {
        $faker = Faker\Factory::create();

        $firstName = $faker->firstName;
        $middleName = $faker->lastName;
        $lastName = $faker->lastName;

        $this->post('patients', [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
        ])->shouldReturnJson()->seeJsonContains([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
        ])->seeJsonStructure([
            'id',
            'full_name',
            'postal_code',
            'address'
        ])->assertResponseOk();
    }

    public function testIndex() {
        //$this->get('diseases')->shouldReturnJson();
    }

    public function testIndexWithId() {
        
    }

    public function testEdit() {
        
    }

    public function testDelete() {
        $faker = Faker\Factory::create();

        $id = DB::table('diseases')->insertGetId([
            'name' => $faker->word,
            'desc' => $faker->sentence,
        ]);

        $this->delete("diseases/{$id}")
                ->shouldReturnJson()
                ->assertResponseOk();
    }

}
