<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DiseaseControllerTest extends TestCase {

    use DatabaseMigrations;

    public function testStore() {
        $faker = Faker\Factory::create();

        $fakeName = $faker->name;
        $fakeDesc = $faker->sentence;
        $this->post('diseases', [
            'name' => $fakeName,
            'desc' => $fakeDesc,
        ])->shouldReturnJson()->seeJsonContains([
            'name' => $fakeName,
            'desc' => $fakeDesc,
        ])->seeJsonStructure([
            'id',
            'name',
            'desc'
        ]);
    }

    public function testIndex() {
        $this->get('diseases')->shouldReturnJson();
    }

    public function testIndexWithId() {
        
    }

}
