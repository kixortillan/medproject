<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfacePatientRepository;
use App\Libraries\Repositories\Core\Exceptions\PatientNotFoundException;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Libraries\Repositories\Core\Repository;
use App\Models\Entity\Patient;
use Carbon\Carbon;
use Exception;

class PatientRepository extends BaseRepository implements InterfacePatientRepository {

    public function __construct() {
        parent::__construct(new Repository('patients'));
    }

    /**
     * 
     * @param int $limit
     * @param int $offset
     * @return \App\Libraries\Repositories\Core\PatientRepository
     * @throws Exception
     */
    public function all(int $limit = null, int $offset = null) {
        try {
            $query = $this->getQueryBuilder();

            if (isset($limit)) {
                $query->limit($limit);
            }

            if (isset($offset)) {
                $query->skip($offset);
            }

            $records = $query->whereNull('deleted_at')
                    ->orderBy('created_at', 'desc')
                    ->get();

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
                $this->result[$temp->getId()] = $temp;
            }

            return $this;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @return type
     * @throws Exception
     */
    public function count() {
        try {
            return $this->getQueryBuilder()
                            ->whereNull('deleted_at')
                            ->count();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param int $id
     * @return type
     * @throws Exception
     */
    public function delete(int $id) {
        try {
            $query = $this->getQueryBuilder();

            return $query->where('id', $id)
                            ->update([
                                'deleted_at' => Carbon::now()->toDateTimeString()
            ]);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @return type
     * @throws Exception
     */
    public function get() {
        try {
            if (is_array($this->result)) {
                return collect($this->result);
            }

            return $this->result;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param int $id
     * @return \App\Libraries\Repositories\Core\PatientRepository
     * @throws Exception
     * @throws PatientNotFoundException
     */
    public function one(int $id) {
        try {
            $query = $this->getQueryBuilder();

            $record = $query->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();

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
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param Patient $model
     * @return \App\Libraries\Repositories\Core\PatientRepository
     * @throws Exception
     */
    public function save(Patient $model) {
        try {
            if (is_null($model->getId())) {
                $id = $this->getQueryBuilder()
                        ->insertGetId([
                    'first_name' => $model->getFirstName(),
                    'middle_name' => $model->getMiddleName(),
                    'last_name' => $model->getLastName(),
                    'postal_code' => $model->getPostalCode(),
                    'created_at' => date('Y-m-d H:i:s'),
                ]);
                $model->setId($id);
            } else {
                $this->getQueryBuilder()
                        ->where('id', $model->getId())
                        ->update([
                            'first_name' => $model->getFirstName(),
                            'middle_name' => $model->getMiddleName(),
                            'last_name' => $model->getLastName(),
                            'postal_code' => $model->getPostalCode(),
                            'updated_at' => date('Y-m-d H:i:s')
                ]);
            }

            $this->result = $model;

            return $this;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param type $columns
     * @param type $keyword
     * @return \App\Libraries\Repositories\Core\PatientRepository
     * @throws Exception
     */
    public function search($columns, $keyword) {
        if ($keyword == '') {
            throw new Exception('Cannot search using empty string');
        }

        try {
            $query = $this->getQueryBuilder();

            if (is_array($columns)) {
                foreach ($columns as $col) {
                    $query->orWhere($col, "like", "%{$keyword}%");
                }
            } else {
                $query->where($columns, "like", "%{$keyword}%");
            }

            $records = $query->limit(50)
                    ->whereNull('deleted_at')
                    ->orderBy('created_at', 'desc')
                    ->get();

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
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
