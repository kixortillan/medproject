<?php

namespace App\Libraries\Entities\Core;

use App\Libraries\Entities\Core\MedicalCase;
use App\Libraries\Entities\Core\Patient;

class MedicalCasePatient {

    /**
     *
     * @var type 
     */
    protected $medicalCase;

    /**
     *
     * @var type 
     */
    protected $patient;

    public function __construct() {
        
    }

    /**
     * 
     * @return type
     */
    public function getMedicalCases() {
        return $this->medicalCase;
    }

    /**
     * 
     * @param MedicalCase $medicalCase
     */
    public function setMedicalCases(MedicalCase $medicalCase) {
        $this->medicalCase = $medicalCase;
    }

    /**
     * 
     * @return type
     */
    public function getPatient() {
        return $this->patient;
    }

    /**
     * 
     * @param Patient $patient
     */
    public function setPatient(Patient $patient) {
        $this->patient = $patient;
    }

}
