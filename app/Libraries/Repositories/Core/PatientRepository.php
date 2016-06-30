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
        $this->setBuilder(DB::table('patients'));
    }

    public function one($id) {
        $record = $this->getBuilder()
                ->find($id);

        if ($record == null) {
            throw new PatientNotFoundException();
        }

        $this->result = new Patient();
        $this->result->setId($record->id);
        $this->result->setFirstName($record->first_name);
        $this->result->setMiddleName($record->middle_name);
        $this->result->setLastName($record->last_name);
        $this->result->setDateRegistered($record->created_at);
        $this->result->setAddress($record->address);
        $this->result->setPostalCode($record->postal_code);

        return $this;
    }

    public function get() {
        return $this->result;
    }

    public function all($limit = null, $offset = null) {
        $query = $this->getBuilder()
                ->orderBy('created_at');

        if (isset($limit)) {
            $query->limit($limit);
        }

        if (isset($offset)) {
            $query->skip($offset);
        }

        $records = $query->get();

        $this->result = [];
        foreach ($records as $record) {
            $temp = new Patient;
            $temp->setId($record->id);
            $temp->setFirstName($record->first_name);
            $temp->setMiddleName($record->middle_name);
            $temp->setLastName($record->last_name);
            $temp->setDateRegistered($record->created_at);
            $temp->setAddress($record->address);
            $temp->setPostalCode($record->postal_code);
            $this->result[] = $temp;
        }

        return $this;
    }

    /**
     * 
     * @return int
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function count() {
        try {
            return $this->getBuilder()
                            ->whereNull('deleted_at')
                            ->count();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function save(Patient $model) {
        try {
            if (is_null($model->getId())) {
                $id = $this->getBuilder()
                        ->insertGetId([
                    'first_name' => $model->getFirstName(),
                    'middle_name' => $model->getMiddleName(),
                    'last_name' => $model->getLastName(),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $model->setId($id);
            } else {
                $this->getBuilder()
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
        $query = $this->getBuilder();

        foreach ($columns as $col) {
            $query->orWhere($col, "like", "%{$keyword}%");
        }

        $records = $query->limit(50)->get();

        $this->result = [];
        foreach ($records as $record) {
            $temp = new Patient();
            $temp->setId($record->id);
            $temp->setFirstName($record->first_name);
            $temp->setMiddleName($record->middle_name);
            $temp->setLastName($record->last_name);
            $temp->setDateRegistered($record->created_at);
            $temp->setAddress($record->address);
            $temp->setPostalCode($record->postal_code);

            $this->result[] = $temp;
        }

        return $this;
    }

}
