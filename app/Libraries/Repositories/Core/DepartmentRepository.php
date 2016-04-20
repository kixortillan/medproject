<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Department;
use App\Models\Core\Disease;
use DB;

class DepartmentRepository extends BaseRepository implements InterfaceDepartmentRepository {

    protected $diseaseTable;
    protected $diseaseMapTable;

    public function __construct() {
        parent::__construct();
        $this->mainTable = 'departments';
        $this->diseaseTable = 'diseases';
        $this->diseaseMapTable = 'department_diseases';
    }

    /**
     * 
     * @param int $id
     * @return Department
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function get($id) {
        try {
            $record = DB::table($this->mainTable)->where('id', $id)
                    ->first();

            $model = new Department();
            $model->setId($record->id);
            $model->setCode($record->code);
            $model->setName($record->name);
            $model->setDesc($record->desc);

            return $model;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @return Department
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function all($limit = null, $offset = null) {
        try {
            $query = DB::table($this->mainTable);

            if (isset($limit)) {
                $query->limit($limit);
            }

            if (isset($offset)) {
                $query->skip($offset);
            }

            $records = $query->get();

            $models = [];
            foreach ($records as $record) {
                $tempModel = new Department();
                $tempModel->setId($record->id);
                $tempModel->setCode($record->code);
                $tempModel->setName($record->name);
                $tempModel->setDesc($record->desc);

                $models[] = $tempModel;
            }

            return $models;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @return int
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function count() {
        try {
            return DB::table($this->mainTable)
                            ->whereNull('deleted_at')
                            ->count();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param Department $model
     * @return Department
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function save(Department $model) {
        try {
            if (is_null($model->getId())) {
                $id = DB::table($this->mainTable)
                        ->insertGetId([
                    'code' => $model->getCode(),
                    'name' => $model->getName(),
                    'desc' => $model->getDesc(),
                ]);
                $model->setId($id);
            } else {
                DB::table($this->mainTable)
                        ->where('id', $model->getId())
                        ->update([
                            'code' => $model->getCode(),
                            'name' => $model->getName(),
                            'desc' => $model->getDesc(),
                ]);
            }
        } catch (Exception $ex) {
            throw $ex;
        }

        return $model;
    }

    /**
     * 
     * @param int $id
     * @return int
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function delete($id) {
        try {
            return DB::table($this->mainTable)
                            ->delete($id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function withDisease() {
        try {
            $records = DB::table($this->mainTable)
                    ->join($this->diseaseMapTable, "{$this->diseaseMapTable}.department_id", "=", "{$this->mainTable}.id")
                    ->join($this->diseaseTable, "{$this->diseaseTable}.id", "=", "{$this->diseaseMapTable}.disease_id")
                    ->get();

            $models = [];
            foreach ($records as $record) {
                $dept = new Department();
                $dept->setId($record->id);
                $dept->setCode($record->code);
                $dept->setName($record->name);
                $dept->setDesc($record->desc);

                $disease = new Disease();
                $disease->setId($record->disease_id);
                $disease->setName($record->name);
                $disease->setDesc($record->desc);

                $dept->addDisease($disease);
                $models[] = $temp;
            }

            return $models;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
