<?php

namespace App\Http\Controllers\Core;

use App\Http\Controllers\Controller;
use App\Libraries\Repositories\Core\DiseaseRepository;

class DiseaseController extends Controller {

    protected $diseaseRepo;

    public function __construct() {
        $this->diseaseRepo = new DiseaseRepository();
    }

    public function index($id = null) {
        if ($id == null) {
            $records = $this->diseaseRepo->all();
        } else {
            $record = $this->diseaseRepo->get($id);
        }
    }

}
