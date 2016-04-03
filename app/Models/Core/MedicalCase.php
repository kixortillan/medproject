<?php

namespace App\Models\Core;

use App\Models\Contracts\InterfaceModel;

class MedicalCase implements InterfaceModel {

    /**
     *
     * @var int 
     */
    protected $id;
    
    /**
     *
     * @var string 
     */
    protected $serialNo;

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
    public function getSerialNo() {
        return $this->serialNo;
    }

    /**
     * 
     * @param string $serialNo
     */
    public function setSerialNo($serialNo) {
        $this->serialNo = $serialNo;
    }

    public function toArray() {
        return [
            'id' => $this->getId(),
            'serial_number' => $this->getSerialNo(),
        ];
    }

}
