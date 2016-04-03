<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Exceptions\DiseaseNotFoundException;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Disease;
use App\Models\Core\Symptom;
use Exception;
use DB;

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
        try {
            $record = DB::table($this->mainTable)->where('id', $id)
                    ->first();
        } catch (Exception $ex) {
            throw $ex;
        }

        if ($record == null) {
            throw new DiseaseNotFoundException();
        }

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
        try {
            $records = DB::table($this->mainTable)->get();
        } catch (Exception $ex) {
            throw $ex;
        }

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
        try {
            $records = DB::table($this->mappingSymptomsTable)
                    ->join($this->symptomsTable, $this->symptomsTable . 'id', '=', $this->mappingSymptomsTable . 'symptom_id')
                    ->where($this->mappingSymptomsTable . 'disease_id', $id)
                    ->get();
        } catch (Exception $ex) {
            throw $ex;
        }

        if (empty($records)) {
            throw new DiseaseNotFoundException();
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

    /**
     * 
     * @param Disease $disease
     * @return Disease
     * @throws Exception
     */
    public function save(Disease $disease) {
        try {
            $id = DB::table($this->mainTable)->insertGetId([
                'name' => $disease->getName(),
                'desc' => $disease->getDesc()
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }

        $disease->setId($id);

        return $disease;
    }

    /**
     * 
     * @param int $id
     * @return int
     */
    public function delete($id) {
        return DB::table($this->mainTable)
                        ->delete($id);
    }

}
