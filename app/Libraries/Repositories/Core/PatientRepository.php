<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfacePatientRepository;
use App\Libraries\Repositories\Core\Exceptions\PatientNotFoundException;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Models\Core\Patient;
use DB;

class PatientRepository extends BaseRepository implements InterfacePatientRepository {

    public function __construct() {
        parent::__construct();
        $this->mainTable = 'patients';
    }

    public function get($id) {
        $record = DB::table($this->mainTable)->find($id);

        if ($record == null) {
            throw new PatientNotFoundException();
        }

        $model = new Patient();
        $model->setId($record->id);
        $model->setFirstName($record->first_name);
        $model->setMiddleName($record->middle_name);
        $model->setLastName($record->last_name);
        $model->setDateRegistered($record->created_at);
        $model->setAddress($record->address);
        $model->setPostalCode($record->postal_code);

        return $model;
    }

    public function all($limit = null, $offset = null) {
        $query = DB::table($this->mainTable)
                ->orderBy('created_at');

        if (isset($limit)) {
            $query->limit($limit);
        }

        if (isset($offset)) {
            $query->skip($offset);
        }

        $records = $query->get();

        $models = [];
        foreach ($records as $record) {
            $temp = new Patient;
            $temp->setId($record->id);
            $temp->setFirstName($record->first_name);
            $temp->setMiddleName($record->middle_name);
            $temp->setLastName($record->last_name);
            $temp->setDateRegistered($record->created_at);
            $temp->setAddress($record->address);
            $temp->setPostalCode($record->postal_code);
            $models[] = $temp;
        }

        return $models;
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

    public function save(Patient $model) {
        try {
            if (is_null($model->getId())) {
                $id = DB::table($this->mainTable)
                        ->insertGetId([
                    'first_name' => $model->getFirstName(),
                    'middle_name' => $model->getMiddleName(),
                    'last_name' => $model->getLastName(),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $model->setId($id);
            } else {
                DB::table($this->mainTable)
                        ->where('id', $model->getId())
                        ->update([
                            'first_name' => $model->getFirstName(),
                            'middle_name' => $model->getMiddleName(),
                            'last_name' => $model->getLastName(),
                            'updated_at' => date('Y-m-d H:i:s')
                ]);
            }
        } catch (Exception $ex) {
            throw $ex;
        }

        return $model;
    }

    public function search($columns = [], $keyword) {
        $query = DB::table($this->mainTable);

        foreach ($columns as $col) {
            $query->orWhere($col, "like", "%{$keyword}%");
        }

        $records = $query->limit(50)->get();

        $models = [];
        foreach ($records as $record) {
            $temp = new Patient();
            $temp->setId($record->id);
            $temp->setFirstName($record->first_name);
            $temp->setMiddleName($record->middle_name);
            $temp->setLastName($record->last_name);
            $temp->setDateRegistered($record->created_at);
            $temp->setAddress($record->address);
            $temp->setPostalCode($record->postal_code);

            $models[] = $temp;
        }

        return $models;
    }

}
