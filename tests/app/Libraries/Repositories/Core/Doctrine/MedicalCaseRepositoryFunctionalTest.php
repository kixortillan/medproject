<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\Doctrine\MedicalCaseRepository;

class MedicalRepositoryFunctionalTest extends TestCase {

    use DatabaseMigrations;

    protected $faker;
    protected $repo;

    public function setUp() {
        parent::setUp();
        $this->repo = new MedicalCaseRepository(app('registry')->getManagerForClass(\App\Libraries\Entities\Core\Department::class));
        $this->faker = Faker\Factory::create();
        //$this->artisan("db:seed", ['--class' => 'DepartmentTestSeeder']);
    }

    public function testFindById() {
        $entity = entity(\App\Libraries\Entities\Core\Patient::class)
                ->create();
        $this->assertInstanceOf(\App\Libraries\Entities\Core\Patient::class, $this->repo->findById($entity->getId()));
    }

    public function testFindByIdFail() {
        $this->assertNull($this->repo->findByCode($this->faker->randomDigitNotNull));
    }

    public function testCount() {
        $count = $this->repo->count();
        $this->assertNotNull($count);
        $this->assertTrue(is_numeric($count));
    }

    public function testFindAllNoSearch() {
        $arrayEntity = entity(\App\Libraries\Entities\Core\Patient::class, 200)
                ->create();

        $search = new App\Libraries\Common\ValueObjects\SearchCriteria(0, 10, 'createdAt', 'asc', [], null);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $this->repo->findAll($search));
    }

    public function testFindAllSearchNotFound() {
        $arrayEntity = entity(\App\Libraries\Entities\Core\Department::class, 200)
                ->create();

        $search = new App\Libraries\Common\ValueObjects\SearchCriteria(0, 10, 'createdAt', 'asc', ['code', 'name', 'description'], 'not found');

        $result = $this->repo->findAll($search);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $result);
        $this->assertTrue($result->isEmpty());
    }

    public function testFindAllSearchFound() {
        $arrayEntity = entity(\App\Libraries\Entities\Core\Department::class, 200)
                ->create();

        $randomElementIndex = mt_rand(0, 200 - 1);

        $search = new App\Libraries\Common\ValueObjects\SearchCriteria(0, 10, 'createdAt', 'asc', ['code', 'name', 'description'], $arrayEntity[$randomElementIndex]->getCode());

        $result = $this->repo->findAll($search);

        $this->assertInstanceOf(\Illuminate\Support\Collection::class, $result);
    }

    public function testSave() {
        $entity = entity(\App\Libraries\Entities\Core\Department::class)->make();

        $this->repo->save($entity);

        $this->assertNotNull($this->repo->findByCode($entity->getCode()));
    }

    public function testDelete() {
        $entity = entity(\App\Libraries\Entities\Core\Department::class)->create();

        $this->repo->delete($entity->getCode());

        $this->assertNull($this->repo->findByCode($entity->getCode()));
    }
    
    public function testPatientsByMedicalCase(){
        
    }
    
    public function testDepartmentHistoryByMedicalCase(){
        
    }
    
    public function testCurrentDepartmentByMedicalCase(){
        
    }

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
