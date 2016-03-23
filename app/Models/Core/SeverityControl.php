<?php

namespace App\Models\Core;

use App\Models\Contracts\InterfaceModel;

class SeverityControl implements InterfaceModel {

    /**
     *
     * @var int 
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $type;

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
        return $this->getId();
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
    public function getType() {
        return $this->type;
    }

    /**
     * 
     * @param string $type
     */
    public function setType($type) {
        $this->type = $type;
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
            'type' => $this->getType(),
            'desc' => $this->getDesc(),
        ];
    }

}
