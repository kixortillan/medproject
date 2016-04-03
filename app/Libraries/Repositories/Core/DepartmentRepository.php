<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Department;

class DepartmentRepository extends BaseRepository implements InterfaceDepartmentRepository {

    public function __construct() {
        parent::__construct();
        $this->mainTable = 'department';
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
    public function all() {
        try {
            $records = DB::table($this->mainTable)->get();

            $models = [];
            foreach ($records as $record) {
                $tempModel = new Department();
                $tempModel->setId($record->id);
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
     * @param Department $model
     * @return Department
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function save(Department $model) {
        try {
            if (is_null($model->getId())) {
                $id = DB::table($this->mainTable)
                        ->insertGetId($model->toArray());
                $model->setId($id);
            } else {
                DB::table($this->mainTable)
                        ->update($model->toArray());
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

}
