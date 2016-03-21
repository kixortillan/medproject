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

    public function get($id) {
        $record = DB::table($this->mainTable)->where('id', $id)
                ->first();

        $model = new Department();
        $model->setId($record->id);
        $model->setName($record->name);
        $model->setDesc($record->desc);

        return $model;
    }

    public function getAll() {
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
    }

    public function save(Department $model) {
        if (is_null($model->getId())) {
            $id = DB::table($this->mainTable)
                    ->insertGetId($model->toArray());
            $model->setId($id);
        } else {
            DB::table($this->mainTable)
                    ->update($model->toArray());
        }

        return $model;
    }

}
