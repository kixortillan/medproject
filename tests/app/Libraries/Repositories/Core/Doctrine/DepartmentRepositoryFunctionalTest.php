<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\Doctrine\DepartmentRepository;

class DepartmentRepositoryFunctionalTest extends TestCase {

    use DatabaseMigrations;

    protected $faker;
    protected $repo;

    public function setUp() {
        parent::setUp();
        $this->repo = new DepartmentRepository(app('registry')->getManagerForClass(\App\Libraries\Entities\Core\Department::class));
        $this->faker = Faker\Factory::create();
        //$this->artisan("db:seed", ['--class' => 'DepartmentTestSeeder']);
    }

    public function testFindByCode() {
        $entity = entity(\App\Libraries\Entities\Core\Department::class)
                ->create();
        $this->assertInstanceOf(\App\Libraries\Entities\Core\Department::class, $this->repo->findByCode($entity->getCode()));
    }

    public function testFindByCodeFail() {
        $this->assertNull($this->repo->findByCode($this->faker->unique()->word));
    }

    public function testCount() {
        $count = $this->repo->count();
        $this->assertNotNull($count);
        $this->assertTrue(is_numeric($count));
    }

    public function testFindAll() {
        $arrayEntity = entity(\App\Libraries\Entities\Core\Department::class, 200)
                ->create();
        
        $search = new App\Libraries\Common\ValueObjects\SearchCriteria(0, 10, 'createdAt', 'asc', [], null);
        
        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $this->repo->findAll($search));
    }

//
//    public function testSave() {
//        
//    }
//
//    public function testSaveFail() {
//        $model = new \App\Libraries\Entities\Core\Department();
//        $model->setCode($this->faker->word);
//        $model->setName($this->faker->word);
//        $model->setDesc($this->faker->sentence);
//        $repo = $this->repo->save($model);
//        $this->assertInstanceOf(DepartmentRepository::class, $repo);
//        $this->assertInstanceOf(\App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository::class, $repo);
//    }
//
//    public function testDelete() {
//        
//    }
//
//    public function testSearch() {
//        $repo = $this->repo->search($this->faker->word, $this->faker->word);
//        $this->assertInstanceOf(DepartmentRepository::class, $repo);
//    }
}
