<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\DiseaseRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class DiseaseController extends Controller {

    /**
     *
     * @var App\Libraries\Repositories\Core\DiseaseRepository 
     */
    protected $diseaseRepo;

    public function __construct() {
        $this->diseaseRepo = new DiseaseRepository();
    }

    /**
     * 
     * @param Request $request
     * @param string $id
     */
    public function index(Request $request, $id = null) {
        try {
            if ($id == null) {
                $records = $this->diseaseRepo->all();
            } else {
                $record = $this->diseaseRepo->get($id);
            }
        } catch (Exception $ex) {
            abort(500);
        }
    }

    /**
     * 
     * @param Request $request
     * @return string
     */
    public function store(Request $request) {
        return 'no';
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     */
    public function edit(Request $request, $id) {
        
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     */
    public function delete(Request $request, $id) {
        
    }

}
