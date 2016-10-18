<?php

namespace App\Libraries\Entities\Core;

use App\Libraries\Entities\Core\Contracts\InterfaceEntity;

class Department implements InterfaceEntity {

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
    protected $description;

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
    public function getDescription() {
        return $this->description;
    }

    /**
     * 
     * @param string $desc
     */
    public function setDescription($desc) {
        $this->description = $desc;
    }
    
    /**
     * 
     * @return type
     */
    public function getDeletetAt() {
        return $this->deletedAt;
    }

    /**
     * 
     * @param type $deletedAt
     */
    public function setDeletedAt($deletedAt) {
        $this->deletedAt = $deletedAt;
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
