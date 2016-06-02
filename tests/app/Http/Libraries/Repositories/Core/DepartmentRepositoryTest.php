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
        $model = new \App\Models\Core\Department();
        $model->setCode($this->faker->word);
        $model->setName($this->faker->word);
        $model->setDesc($this->faker->sentence);
        $repo = $this->repo->save($model);
        $this->assertInstanceOf(DepartmentRepository::class, $repo);
        $this->assertInstanceOf(\App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository::class, $repo);
        $repo->get(\App\Models\Contracts\InterfaceModel::class, $repo->get());
        $repo->get(\App\Models\Core\Department::class, $repo->get());
    }

    public function testDelete() {
        
    }

    public function testSearch() {
        $repo = $this->repo->search();
        $this->assertInstanceOf(DepartmentRepository::class, $repo);
    }

}
