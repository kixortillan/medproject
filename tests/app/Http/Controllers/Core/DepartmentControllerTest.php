<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Services\Core\DepartmentService;

class DepartmentControllerTest extends TestCase {

    use DatabaseMigrations;

    protected $faker;
    protected $repo;

    public function setUp() {
        parent::setUp();
        $this->repo = new DepartmentRepository(app('registry')->getManagerForClass(\App\Libraries\Entities\Core\Department::class));
        $this->faker = Faker\Factory::create();
        //$this->artisan("db:seed", ['--class' => 'DepartmentTestSeeder']);
    }

    public function testIndexWithId() {
        $entity = entity(\App\Libraries\Entities\Core\Department::class)
                ->create();
        $this->json("GET", "departments/{$entity->getCode()}");
    }

}
