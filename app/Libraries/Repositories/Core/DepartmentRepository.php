<?php

namespace App\Libraries\Repositories\Core;

use App\Libraries\Repositories\Core\Contracts\InterfaceDepartmentRepository;
use App\Libraries\Repositories\Core\Exceptions\DepartmentNotFoundException;
use App\Libraries\Repositories\Core\BaseRepository;
use App\Libraries\Repositories\Core\Repository;
use App\Models\Entity\Department;
use Exception;
use DB;

class DepartmentRepository extends BaseRepository implements InterfaceDepartmentRepository {

    protected $diseaseTable;
    protected $diseaseMapTable;
    protected $result;

    public function __construct() {
        parent::__construct(new Repository('departments'));
        $this->diseaseTable = 'diseases';
        $this->diseaseMapTable = 'department_diseases';
    }

    /**
     * 
     * @return mixed
     */
    public function get() {
        return $this->result;
    }

    /**
     * 
     * @param type $id
     * @return Department
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function one($id) {
        try {
            $query = $this->getQueryBuilder();

            $record = $query
                    ->where('id', $id)
                    ->first();

            if (!isset($record)) {
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
     * @return Department
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function all($limit = null, $offset = null) {
        try {
            $query = $this->getQueryBuilder();

            if (isset($limit)) {
                $query->limit($limit);
            }

            if (isset($offset)) {
                $query->skip($offset);
            }

            $records = $query->get();

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

            return $query
                            ->whereNull('deleted_at')
                            ->count();
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
                $id = $query
                        ->insertGetId([
                    'code' => $model->getCode(),
                    'name' => $model->getName(),
                    'desc' => $model->getDesc(),
                ]);
                $model->setId($id);
            } else {
                $query
                        ->where('id', $model->getId())
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
     * @param int $id
     * @return int
     * @throws \App\Libraries\Repositories\Core\Exception
     */
    public function delete($id) {
        try {
            $query = $this->getQueryBuilder();

            return $query
                            ->delete($id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * 
     * @param string $keyword
     * @param array $columns
     * @return \App\Libraries\Repositories\Core\DepartmentRepository
     */
    public function search($keyword = null, array $columns = []) {
        $query = $this->getQueryBuilder();

        if (!empty($keyword)) {
            foreach ($columns as $col) {
                $query
                        ->orWhere($col, "like", "%{$keyword}%");
            }
        }

        $records = $query
                ->limit(50)
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
    }

}
