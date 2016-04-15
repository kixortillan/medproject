<?php

namespace App\Models\Core;

use App\Models\Contracts\InterfaceModel;
use App\Models\BaseModel;

class Patient extends BaseModel implements InterfaceModel {

    /**
     *
     * @var int 
     */
    protected $id;

    /**
     *
     * @var string 
     */
    protected $firstName = '';

    /**
     *
     * @var string 
     */
    protected $middleName = '';

    /**
     *
     * @var string 
     */
    protected $lastName = '';

    /**
     *
     * @var string 
     */
    protected $dateRegistered = '';

    /**
     *
     * @var string 
     */
    protected $address = '';

    /**
     *
     * @var string 
     */
    protected $postalCode = '';

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
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * 
     * @param string $firstName
     */
    public function setFirstName($firstName) {
        if (is_null($firstName)) {
            return;
        }

        $this->firstName = $firstName;
    }

    /**
     * 
     * @return string
     */
    public function getMiddleName() {
        return $this->middleName;
    }

    /**
     * 
     * @param string $middleName
     */
    public function setMiddleName($middleName) {
        if (is_null($middleName)) {
            return;
        }

        $this->middleName = $middleName;
    }

    /**
     * 
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * 
     * @param string $lastName
     */
    public function setLastName($lastName) {
        if (is_null($lastName)) {
            return;
        }

        $this->lastName = $lastName;
    }

    /**
     * 
     * @return string
     */
    public function getDateRegistered() {
        return $this->dateRegistered;
    }

    /**
     * 
     * @param string $date
     */
    public function setDateRegistered($date) {
        if (is_null($date)) {
            return;
        }

        $this->dateRegistered = $date;
    }

    /**
     * 
     * @return string
     */
    public function getAddress() {
        return $this->address;
    }

    /**
     * 
     * @param string $address
     */
    public function setAddress($address) {
        if (is_null($address)) {
            return;
        }

        $this->address = $address;
    }

    /**
     * 
     * @return string
     */
    public function getPostalCode() {
        return $this->postalCode;
    }

    /**
     * 
     * @param string $postalCode
     */
    public function setPostalCode($postalCode) {
        if (is_null($postalCode)) {
            return;
        }

        $this->postalCode = $postalCode;
    }

    /**
     * 
     * @return string
     */
    public function getFullname() {
        if (empty($this->getMiddleName())) {
            return sprintf("%s %s", $this->getFirstName(), $this->getLastName());
        } else {
            return sprintf("%s %s %s", $this->getFirstName(), $this->getMiddleName(), $this->getLastName());
        }
    }

    public function toArray() {
        return [
            'id' => $this->getId(),
            'full_name' => $this->getFullname(),
            'date_registered' => $this->getDateRegistered(),
            'postal_code' => $this->getPostalCode(),
            'address' => $this->getAddress(),
        ];
    }

}
