<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Disease;

class DiseaseRepository extends BaseRepository {

    public function __construct() {
        parent::__construct();
        $this->mainTable = 'diseases';
    }

    /**
     * 
     * @param int $id
     * @return Disease
     */
    public function get($id) {
        $record = DB::table($this->mainTable)->where('id', $id)
                ->first();

        $model = new Disease();
        $model->setId($record->id);
        $model->setName($record->name);
        $model->setDesc($record->desc);

        return $model;
    }

    /**
     * 
     * @return array \App\Models\Core\Disease
     */
    public function getAll() {
        $records = DB::table($this->mainTable)->get();

        $models = [];
        foreach ($records as $record) {
            $tempModel = new Disease();
            $tempModel->setId($record->id);
            $tempModel->setName($record->name);
            $tempModel->setDesc($record->desc);

            $models[] = $tempModel;
        }

        return $models;
    }

}
