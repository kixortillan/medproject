<?php

namespace App\Models\Core;

use App\Models\Contracts\InterfaceModel;
use App\Models\Core\SeverityControl;
use App\Models\Core\Symptom;

class Disease implements InterfaceModel {

    /**
     *
     * @var int 
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $name;

    /**
     *
     * @var string 
     */
    protected $desc;

    /**
     *
     * @var \App\Models\Core\SeverityControl
     */
    protected $severityControl;

    /**
     *
     * @var array App\Models\Core\Symptom
     */
    protected $symptoms;

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
    public function getName() {
        return $this->name;
    }

    /**
     * 
     * @param string $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * 
     * @return string
     */
    public function getDesc() {
        return $this->desc;
    }

    /**
     * 
     * @param string $desc
     */
    public function setDesc($desc) {
        $this->desc = $desc;
    }

    /**
     * 
     * @return \App\Models\Core\SeverityControl
     */
    public function getSeverityControl() {
        return $this->severityControl;
    }

    /**
     * 
     * @param \App\Models\Core\SeverityControl $severityControl
     */
    public function setSeverityControl(SeverityControl $severityControl) {
        $this->severityControl = $severityControl;
    }

    /**
     * 
     * @param \App\Models\Core\Symptom $symptom
     */
    public function addSymptom(Symptom $symptom) {
        $this->symptoms[$symptom->getCode()] = $symptom;
    }

    /**
     * 
     * @return array \App\Models\Core\Symptom
     */
    public function getAllSymptoms() {
        return $this->symptoms;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        $symptoms = [];
        
        foreach ($this->getAllSymptoms() as $symptom) {
            $symptoms[] = $symptom->toArray();
        }
        
        return [
            'id' => $this->getId(),
            'name' => $this->getName(),
            'desc' => $this->getDesc(),
            'symptoms' => $symptoms,
            'sevirity_control' => $this->getSeverityControl(),
        ];
    }

}
