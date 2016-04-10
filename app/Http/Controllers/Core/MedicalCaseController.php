<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\MedicalCaseRepository;
use App\Http\Controllers\Controller;
use Exception;

class MedicalCaseController extends Controller {

    protected $medicalCaseRepo;

    public function __construct() {
        $this->medicalCaseRepo = new MedicalCaseRepository();
    }

    public function index() {
        
    }

    public function store() {
        try {
            
        } catch (Exception $ex) {
            
        }
    }

    public function edit() {
        
    }

    public function delete() {
        
    }

}
