<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use App\Libraries\Repositories\Core\Exceptions\DepartmentNotFoundException;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Libraries\Repositories\Core\Repository;
use App\Models\Entity\Department;
use Exception;

class DepartmentRepository extends BaseRepository implements InterfaceDepartmentRepository {

    public function __construct() {
        parent::__construct(new Repository('departments'));
    }

    /**
     * 
     * @return Department
     * @throws \App\Libraries\Repositories\Core\Exception
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
                $tempModel = new Department();
                $tempModel->setId($record->id);
                $tempModel->setCode($record->code);
                $tempModel->setName($record->name);
                $tempModel->setDesc($record->desc);

                $this->result[$tempModel->getId()] = $tempModel;
            }

            return $this;
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
            $query = $this->getQueryBuilder();

            return $query->whereNull('deleted_at')
                            ->count();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param int $id
     * @return int
     * @throws \App\Libraries\Repositories\Core\Exception
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
     * @return Collection|Object
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
     * @return \App\Libraries\Repositories\Core\DepartmentRepository
     * @throws Exception
     * @throws DepartmentNotFoundExceptions
     */
    public function one(int $id) {
        try {
            $query = $this->getQueryBuilder();

            $record = $query->where('id', $id)
                    ->whereNull('deleted_at')
                    ->first();

            if ($record == null) {
                throw new DepartmentNotFoundException();
            }

            $this->result = new Department();
            $this->result->setId($record->id);
            $this->result->setCode($record->code);
            $this->result->setName($record->name);
            $this->result->setDesc($record->desc);

            return $this;
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
            $query = $this->getQueryBuilder();

            if (is_null($model->getId())) {
                $id = $query->insertGetId([
                    'code' => $model->getCode(),
                    'name' => $model->getName(),
                    'desc' => $model->getDesc(),
                ]);
                $model->setId($id);
            } else {
                $query->where('id', $model->getId())
                        ->update([
                            'code' => $model->getCode(),
                            'name' => $model->getName(),
                            'desc' => $model->getDesc(),
                ]);
            }
        } catch (Exception $ex) {
            throw $ex;
        }

        $this->result = $model;

        return $this;
    }

    /**
     * 
     * @param type $columns
     * @param type $keyword
     * @return \App\Libraries\Repositories\Core\DepartmentRepository
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
                $temp = new Department();
                $temp->setId($record->id);
                $temp->setName($record->name);
                $temp->setCode($record->code);
                $temp->setDesc($record->desc);

                $this->result[] = $temp;
            }

            return $this;
        } catch (Exception $ex) {
            throw $ex;
        }
    }

}
