<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;

class Controller extends BaseController {

    /**
     *
     * @var array 
     */
    private $responseBag = [
        'type' => '',
        'data' => [],
    ];

    /**
     * 
     * @param mixed $data
     * @return 
     */
    protected function setData($data) {
        if (is_null($data)) {
            return;
        }

        $this->responseBag['data'][] = $data;
    }

    /**
     * 
     * @return mixed
     */
    protected function getData() {
        return $this->responseBag['data'];
    }

    /**
     * 
     * @param string $type
     * @return
     */
    protected function setType($type) {
        if (is_null($type)) {
            return;
        }

        $this->responseBag['type'] = $type;
    }

    /**
     * 
     * @return string
     */
    protected function getType() {
        return $this->responseBag['type'];
    }

    /**
     * 
     * @return array
     */
    protected function getResponseBag() {
        return $this->responseBag;
    }

    /**
     * 
     * @param type $key
     * @param type $value
     * @return type
     */
    protected function addItem($key, $value) {
        $this->responseBag[$key] = $value;
    }

}
