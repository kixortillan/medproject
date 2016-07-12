<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\MedicalCaseRepository;

class MedicalCaseRepositoryTest extends TestCase {

    use DatabaseMigrations;

    protected $faker;
    protected $repo;

    public function setUp() {
        parent::setUp();
        $this->repo = new MedicalCaseRepository();
        $this->faker = Faker\Factory::create();
        $this->artisan("db:seed", ['--class' => 'MedicalCaseTestSeeder']);
    }

    public function testGet() {
        $this->assertNull($this->repo->get());
    }

    public function testOne() {
        $this->repo->one(-1);
    }

}
