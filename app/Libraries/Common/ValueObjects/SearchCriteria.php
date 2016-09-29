<?php

namespace App\Libraries\Common\ValueObjects;

class SearchCriteria {

    /**
     *
     * @var type 
     */
    protected $limit = 10;

    /**
     *
     * @var type 
     */
    protected $offset = 0;

    /**
     *
     * @var type 
     */
    protected $columns;

    /**
     *
     * @var type 
     */
    protected $keyword;

    /**
     *
     * @var type 
     */
    protected $sortBy;

    /**
     *
     * @var type 
     */
    protected $order = 'asc';

    public function __construct(int $offset = 0, int $limit = 10, string $sortBy = null, string $order = 'asc', $columns = null, string $keyword = null) {
        $this->offset = $offset;
        $this->limit = $limit;
        $this->sortBy = $sortBy;
        $this->order = $order;
        $this->keyword = $keyword;
        $this->columns = is_array($columns) ? $columns : [$columns];
    }

    public function getOffset() {
        return $this->offset;
    }

    public function getLimit() {
        return $this->limit;
    }

    public function getColumns() {
        return $this->columns;
    }

    public function getKeyword() {
        return $this->keyword;
    }

    public function getSortBy() {
        return $this->sortBy;
    }

    public function getOrder() {
        return $this->order;
    }

}
