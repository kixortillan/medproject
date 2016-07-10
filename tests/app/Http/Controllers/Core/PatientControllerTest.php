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
        $postalCode = $faker->postcode;

        $http = $this->post('patients', [
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
            'postal_code' => $postalCode,
        ]);
        $http->assertResponseOk();
        $http->shouldReturnJson();
        $http->seeJsonContains([
            'first_name' => $firstName,
            'middle_name' => $middleName,
            'last_name' => $lastName,
        ]);
        $http->seeJsonStructure([
            'data' => [
                'patient' => [
                    'id',
                    'full_name',
                    'postal_code',
                    'address'
                ]
            ]
        ]);
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
