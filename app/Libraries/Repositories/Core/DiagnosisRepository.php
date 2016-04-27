<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Diagnosis;
use DB;

class DiagnosisRepository extends BaseRepository {

    public function __construct() {
        parent::__construct();
        $this->mainTable = 'diagnoses';
    }

    public function get($id) {
        try {
            $record = DB::table($this->mainTable)->where('id', $id)
                    ->first();

            $diagnosis = new Diagnosis();
            $diagnosis->setId($record->id);
            $diagnosis->setName($record->name);
            $diagnosis->setDesc($record->desc);

            return $diagnosis;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function save(Diagnosis $diagnosis) {
        try {
            if (is_null($diagnosis->getId())) {
                $id = DB::table($this->mainTable)
                        ->insertGetId([
                    'name' => $diagnosis->getName(),
                    'desc' => $diagnosis->getDesc(),
                ]);
                $diagnosis->setId($id);
            } else {
                DB::table($this->mainTable)
                        ->where('id', $diagnosis->getId())
                        ->update([
                            'name' => $diagnosis->getName(),
                            'desc' => $diagnosis->getDesc(),
                ]);
            }
        } catch (Exception $ex) {
            throw $ex;
        }

        return $diagnosis;
    }

    public function search($columns = [], $keyword) {
        $query = DB::table($this->mainTable);

        foreach ($columns as $col) {
            $query->orWhere($col, "LIKE", "%{$keyword}%");
        }

        $records = $query->limit(50)->get();

        $models = [];
        foreach ($records as $record) {
            $temp = new Diagnosis();
            $temp->setId($record->id);
            $temp->setName($record->name);
            $temp->setDesc($record->desc);

            $models[] = $temp;
        }

        return $models;
    }

}
