<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\DepartmentRepository;

class DepartmentRepositoryTest extends TestCase {

    public function testGet() {
        $repo = new DepartmentRepository();
        $this->assertNull($repo->get());
    }
    
    public function testGetBuilder(){
        $repo = new DepartmentRepository();
        $this->setExpectedException(Throwable);
        $repo->getBuilder();
    }

}
