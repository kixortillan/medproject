<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Disease;
use App\Models\Core\Symptom;

class DiseaseRepository extends BaseRepository {

    /**
     *
     * @var string 
     */
    protected $symptomsTable = 'symptoms';

    /**
     *
     * @var string 
     */
    protected $mappingSymptomsTable = 'disease_symptoms';

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
    public function all() {
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

    /**
     * 
     * @param type $id
     * @return Disease
     * @throws Exception
     */
    public function withSymptoms($id) {
        $records = DB::table($this->mappingSymptomsTable)
                ->join($this->symptomsTable, $this->symptomsTable . 'id', '=', $this->mappingSymptomsTable . 'symptom_id')
                ->where($this->mappingSymptomsTable . 'disease_id', $id)
                ->get();

        if (empty($records)) {
            throw new Exception('Record not found.');
        }

        $model = new Disease();
        $model->setId($records[0]->id);
        $model->setName($records[0]->name);
        $model->setDesc($records[0]->desc);

        foreach ($records as $record) {
            $temp = new Symptom();
            $temp->setId($record->symptom_id);
            $temp->setCode($record->code);
            $temp->setDesc($record->desc);

            $model->addSymptom($temp);
        }

        return $model;
    }

}
