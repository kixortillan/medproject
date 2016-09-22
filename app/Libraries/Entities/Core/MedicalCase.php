<?php

namespace App\Libraries\Entities\Core;

class MedicalCase {

    /**
     *
     * @var int 
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $serialNum;

    /**
     *
     * @var type 
     */
    protected $departments = [];

    /**
     *
     * @var type 
     */
    protected $patients = [];

    /**
     *
     * @var type 
     */
    protected $diagnoses = [];

    /**
     *
     * @var type 
     */
    protected $createdAt;

    /**
     *
     * @var type 
     */
    protected $updatedAt;

    /**
     *
     * @var type 
     */
    protected $deletedAt;

    /**
     * 
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * 
     * @param int $id
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * 
     * @return string
     */
    public function getSerialNum() {
        return $this->serialNum;
    }

    /**
     * 
     * @param string $serialNum
     */
    public function setSerialNum($serialNum) {
        $this->serialNum = $serialNum;
    }

    /**
     * 
     * @return type
     */
    public function getDepartments() {
        return $this->departments;
    }

    /**
     * 
     * @param \App\Models\Entity\Department $department
     */
    public function addDepartment(Department $department) {
        $this->departments[] = $department;
    }

    /**
     * 
     * @return type
     */
    public function getPatients() {
        return $this->patients;
    }

    /**
     * 
     * @param \App\Models\Entity\Patient $patient
     */
    public function addPatient(Patient $patient) {
        $this->patients[] = $patient;
    }

    /**
     * 
     * @return array
     */
    public function getDiagnoses() {
        return $this->diagnoses;
    }

    /**
     * 
     * @param \App\Models\Entity\Diagnosis $diagnosis
     */
    public function addDiagnoses(Diagnosis $diagnosis) {
        $this->diagnoses[] = $diagnosis;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        $dept = [];
        foreach ($this->getDepartments() as $val) {
            $dept[] = $val->toArray();
        }

        $patients = [];
        foreach ($this->getPatients() as $val) {
            $patients[] = $val->toArray();
        }

        $diagnoses = [];
        foreach ($this->getDiagnoses() as $val) {
            $diagnoses[] = $val->toArray();
        }

        return [
            'id' => $this->getId(),
            'serial_num' => $this->getSerialNum(),
            'departments' => $dept,
            'patients' => $patients,
            'diagnoses' => $diagnoses,
        ];
    }

}
