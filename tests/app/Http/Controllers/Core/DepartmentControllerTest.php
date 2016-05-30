<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;

class DepartmentControllerTest extends TestCase {

    use DatabaseMigrations;

    public function testStore() {
        $faker = Faker\Factory::create();

        $fakeName = $faker->name;
        $fakeDesc = $faker->sentence;
        $fakeCode = $faker->word;
        $this->post('departments', [
            'code' => $fakeCode,
            'name' => $fakeName,
            'desc' => $fakeDesc,
        ])->shouldReturnJson()->seeJsonContains([
            'code' => $fakeCode,
            'name' => $fakeName,
            'desc' => $fakeDesc,
        ])->seeJsonStructure([
            'id',
            'code',
            'name',
            'desc'
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

        $id = DB::table('departments')->insertGetId([
            'code' => $faker->text(10),
            'name' => $faker->word,
            'desc' => $faker->sentence,
        ]);

        $this->delete("diseases/{$id}")
                ->shouldReturnJson()
                ->assertResponseOk();
    }

}
