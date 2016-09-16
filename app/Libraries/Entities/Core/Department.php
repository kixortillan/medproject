<?php

namespace App\Libraries\Entities\Core;

class Department {

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
    protected $name;

    /**
     *
     * @var string 
     */
    protected $desc;

    /**
     *
     * @var array \App\Models\Entity\Disease 
     */
    protected $diseases = [];
    
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
     * @param \App\Models\Entity\Disease $disease
     */
    public function addDisease(Disease $disease) {
        $this->diseases[$disease->getName()] = $disease;
    }

    /**
     * 
     * @param string $name
     * @return \App\Models\Entity\Disease 
     */
    public function getDisease($name) {
        return $this->diseases[$name];
    }

    /**
     * 
     * @return array \App\Models\Entity\Disease 
     */
    public function getAllDiseases() {
        return $this->diseases;
    }

    /**
     * 
     * @return array
     */
    public function toArray() {
        $diseases = [];

        foreach ($this->getAllDiseases() as $disease) {
            $diseases[] = $disease->toArray();
        }

        return [
            'id' => $this->getId(),
            'code' => $this->getCode(),
            'name' => $this->getName(),
            'desc' => $this->getDesc(),
            'diseases' => $diseases,
        ];
    }

}
