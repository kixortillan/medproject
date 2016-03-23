<?php

namespace App\Models\Core;

use App\Models\Contracts\InterfaceModel;

class Symptom implements InterfaceModel {

    /**
     *
     * @var int 
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $code;

    /**
     *
     * @var string 
     */
    protected $desc;

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
    public function getCode() {
        return $this->code;
    }

    /**
     * 
     * @param string $code
     */
    public function setCode($code) {
        $this->code = $code;
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
     * @return array
     */
    public function toArray() {
        return [
            'id' => $this->getId(),
            'code' => $this->getCode(),
            'desc' => $this->getDesc(),
        ];
    }

}
