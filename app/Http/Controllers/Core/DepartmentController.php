<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\DepartmentRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Core\Department;
use Exception;

class DepartmentController extends Controller {

    protected $departmentRepo;

    public function __construct() {
        $this->departmentRepo = new DepartmentRepository();
    }

    public function index(){
        
    }
    
    public function store(){
        
    }
    
    public function edit(){
        
    }
    
    public function delete() {
        
    }

}
