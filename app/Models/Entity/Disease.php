<?php

namespace App\Models\Entity;

use App\Models\Contracts\InterfaceModel;
use App\Models\Entity\SeverityControl;
use App\Models\Entity\Symptom;

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
     * @var \App\Models\Entity\SeverityControl
     */
    protected $severityControl;

    /**
     *
     * @var array App\Models\Entity\Symptom
     */
    protected $symptoms = [];

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
     * @return \App\Models\Entity\SeverityControl
     */
    public function getSeverityControl() {
        return $this->severityControl;
    }

    /**
     * 
     * @param \App\Models\Entity\SeverityControl $severityControl
     */
    public function setSeverityControl(SeverityControl $severityControl) {
        $this->severityControl = $severityControl;
    }

    /**
     * 
     * @param \App\Models\Entity\Symptom $symptom
     */
    public function addSymptom(Symptom $symptom) {
        $this->symptoms[$symptom->getCode()] = $symptom;
    }

    /**
     * 
     * @return array \App\Models\Entity\Symptom
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
