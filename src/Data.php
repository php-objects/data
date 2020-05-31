<?php

namespace Base;

/**
 * A data-object that can be extended and decorated with traits.
 */
class Data {

    /**
     * @var array
     */
    protected $data = [];

    /**
     * @var bool[]
     */
    protected $diff = [];

    /**
     * @param array $data
     */
    public function __construct (array $data = []) {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function __debugInfo (): array {
        return $this->data;
    }

    /**
     * @return bool
     */
    public function isDiff (): bool {
        return (bool)$this->diff;
    }

    /**
     * @return array
     */
    public function toArray (): array {
        return $this->data;
    }

    /**
     * @return array
     */
    public function toDiff (): array {
        return array_intersect_key($this->data, $this->diff);
    }
}