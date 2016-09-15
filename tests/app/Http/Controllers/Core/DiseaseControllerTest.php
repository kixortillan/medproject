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
        ])->assertResponseOk();
    }

    public function testIndex() {
        //$this->get('diseases')->shouldReturnJson();
    }

    public function testIndexWithId() {
        
    }
    
    public function testEdit(){
        
    }
    
    public function testDelete() {
        $faker = Faker\Factory::create();

        $id = DB::table('diseases')->insertGetId([
            'name' => $faker->word,
            'desc' => $faker->sentence,
        ]);

        $this->delete("diseases/{$id}")
                ->assertResponseOk();
    }

}
