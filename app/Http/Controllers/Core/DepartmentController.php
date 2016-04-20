<?php

namespace App\Http\Controllers\Core;

use App\Libraries\Repositories\Core\DepartmentRepository;
use App\Http\Controllers\Controller;
use App\Models\Core\Department;
use Illuminate\Http\Request;
use Exception;

class DepartmentController extends Controller {

    protected $departmentRepo;

    public function __construct() {
        $this->departmentRepo = new DepartmentRepository();
    }

    public function index(Request $request, $id = null) {
        try {
            if ($id != null) {
                $this->setData($this->departmentRepo->get($id)->toArray());
            } else {
                $page = $request->query('page', 1);
                $limit = $request->query('per_page', 5);

                $models = $this->departmentRepo->all($limit, $limit * ($page - 1));

                $departments = [];
                foreach ($models as $model) {
                    $departments[] = $model->toArray();
                }

                $this->setData('departments', $departments);
                $this->addItem('total', ceil($this->departmentRepo->count() / $limit));
                $this->addItem('per_page', $limit);
            }

            $this->setType(Department::getModelName());
        } catch (Exception $ex) {
            throw $ex;
        }

        return response()->json($this->getResponseBag());
    }

    public function store(Request $request) {
        $code = $request->get('code', null);
        $name = $request->get('name', null);
        $desc = $request->get('desc', null);

        try {
            $this->validate($request, [
                'code' => 'bail|required|alphanum',
                'name' => 'bail|required|alphanum',
                'desc' => 'bail|alphanum'
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $model = new Department();
            $model->setCode($code);
            $model->setName($name);
            $model->setDesc($desc);

            $model = $this->departmentRepo->save($model);

            return response()->json($model->toArray());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function edit(Request $request, $id) {
        $code = $request->get('code', null);
        $name = $request->get('name', null);
        $desc = $request->get('desc', null);

        try {
            $this->validate($request, [
                'code' => 'bail|required|alphanum',
                'name' => 'bail|required|alphanum',
                'desc' => 'bail|alphanum'
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        try {
            $model = new Department();
            $model->setCode($code);
            $model->setName($name);
            $model->setDesc($desc);

            $model = $this->departmentRepo->save($model);

            return response()->json($model->toArray());
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function delete(Request $request, $id) {
        try {
            $this->departmentRepo->delete($id);

            return response()->json();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function getWithDiseases(Request $request, $id, $diseaseId = null) {
        
    }

}
