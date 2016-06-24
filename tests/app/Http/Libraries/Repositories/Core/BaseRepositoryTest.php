<?php

use Laravel\Lumen\Testing\DatabaseMigrations;
use Laravel\Lumen\Testing\DatabaseTransactions;
use App\Libraries\Repositories\Core\BaseRepository;

class BaseRepositoryTest extends TestCase {

    public function testGetBuilderWithErrors() {
        $this->setExpectedException(Exception::class);
        $this->repo->getBuilder();
    }

}
