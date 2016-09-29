<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\Doctrine\DepartmentRepository;

class DepartmentRepositoryUnitTest extends TestCase {

    use DatabaseMigrations;

    protected $faker;
    protected $repo;
    protected $mockManager;

    public function setUp() {
        parent::setUp();
        $this->mockManager = $this->getMockBuilder(\Doctrine\ORM\EntityManager::class)
                ->disableOriginalConstructor()
                ->getMock();
        //$this->repo = new DepartmentRepository($this->mockManager);
        $this->faker = Faker\Factory::create();
        //$this->artisan("db:seed", ['--class' => 'DepartmentTestSeeder']);
    }

    public function testFindByCode() {
        $code = $this->faker->word;
        
        $this->mockManager->expects($this->once())
                ->method('getRepository')
                ->with(\App\Libraries\Entities\Core\Department::class)
                ->will($this->returnValue(app('registry')->getManagerForClass(\App\Libraries\Entities\Core\Department::class)->getRepository(\App\Libraries\Entities\Core\Department::class)));

        /*$this->mockManager->expects($this->once())
                ->method('findOneBy')
                ->withAnyParameters()
                ->will($this->returnValue(new \App\Libraries\Entities\Core\Department()));*/

        $this->repo = new DepartmentRepository($this->mockManager);
        $this->assertNull($this->repo->findByCode($code));
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
