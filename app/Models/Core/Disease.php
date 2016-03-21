<?php

namespace App\Models\Core;

use App\Models\Core\SeverityControl;
use App\Models\Core\Symptom;

class Disease {

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
     * @return \App\Models\Core\SeverityControlv
     */
    /* public function getSeverityControl() {
      return $this->severityControl;
      } */

    /**
     * 
     * @param SeverityControl $severityControl
     */
    /* public function setSeverityControl(SeverityControl $severityControl) {
      $this->severityControl = $severityControl;
      } */

    /**
     * 
     * @return array
     */
    public function toArray() {
        return [
        ];
    }

}
