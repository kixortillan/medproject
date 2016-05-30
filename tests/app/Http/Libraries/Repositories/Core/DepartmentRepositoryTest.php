<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\DepartmentRepository;

class DepartmentRepositoryTest extends TestCase {

    use DatabaseTransactions,
        DatabaseMigrations;

    protected $faker;
    protected $repo;

    public function setUp() {
        parent::setUp();
        $this->repo = new DepartmentRepository();
        $this->faker = Faker\Factory::create();
        $this->artisan("db:seed", ['--class' => 'DepartmentTestSeeder']);
    }

    public function testGet() {
        $this->assertNull($this->repo->get());
    }

    public function testGetBuilderWithErrors() {
        $this->setExpectedException(Exception::class);
        $this->repo->getBuilder();
    }

    public function testOneWithErrors() {
        $this->setExpectedException(App\Libraries\Repositories\Core\Exceptions\DepartmentNotFoundException::class);
        $this->repo->one($this->faker->randomNumber());
    }

    public function testAllWithErrors() {
        
    }

    public function testCount() {
        $count = $this->repo->count();
        $this->assertNotNull($count);
        $this->assertTrue(is_numeric($count));
    }

    public function testSave() {
        
    }

    public function testDelete() {
        
    }

    public function testSearch() {
        
    }

}
