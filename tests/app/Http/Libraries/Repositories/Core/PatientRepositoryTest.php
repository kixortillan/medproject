<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\PatientRepository;

class PatientRepositoryTest extends TestCase {

    use DatabaseMigrations;

    protected $faker;
    protected $repo;

    public function setUp() {
        parent::setUp();
        $this->repo = new PatientRepository();
        $this->faker = Faker\Factory::create();
        $this->artisan("db:seed", ['--class' => 'PatientTestSeeder']);
    }

    public function testGet() {
        $this->assertNull($this->repo->get());
    }

    public function testOneWithErrors() {
        $this->setExpectedException(App\Libraries\Repositories\Core\Exceptions\PatientNotFoundException::class);
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
        $model = new \App\Models\Entity\Patient();
        $model->setFirstName($this->faker->firstName);
        $model->setMiddleName($this->faker->lastName);
        $model->setLastName($this->faker->lastName);
        $model->setPostalCode($this->faker->postcode);
        $repo = $this->repo->save($model);
        $this->assertInstanceOf(PatientRepository::class, $repo);
        $this->assertInstanceOf(\App\Libraries\Repositories\Core\Contracts\InterfacePatientRepository::class, $repo);
        $repo->get(\App\Models\Contracts\InterfaceModel::class, $repo->get());
        $repo->get(\App\Models\Entity\Patient::class, $repo->get());
    }

    public function testDelete() {
        
    }

    public function testSearch() {
        $repo = $this->repo->search($this->faker->word, $this->faker->word);
        $this->assertInstanceOf(PatientRepository::class, $repo);
    }

}
