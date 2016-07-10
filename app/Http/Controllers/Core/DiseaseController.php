<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\DiseaseRepository;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Entity\Disease;
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
                $records = $this->diseaseRepo->get($id);
            }

            return response()->json($records->toArray());
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
        try {
            $name = $request->get('name', null);
            $desc = $request->get('desc', null);

            $model = new Disease();

            $model->setName($name);
            $model->setDesc($desc);

            $model = $this->diseaseRepo->save($model);

            return response()->json($model->toArray());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     */
    public function edit(Request $request, $id) {
        try{
            $this->diseaseRepo->delete($id);
        } catch (Exception $ex) {

        }
        return response()->json(['id' => $id]);
    }

    /**
     * 
     * @param Request $request
     * @param type $id
     */
    public function delete(Request $request, $id) {
        
    }

}
