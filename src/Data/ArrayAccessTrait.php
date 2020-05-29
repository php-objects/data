<?php

namespace Base\Data;

use Base\Data;

/**
 * @mixin Data
 */
trait ArrayAccessTrait {

    /**
     * @param mixed $offset
     * @return bool
     */
    public function offsetExists ($offset): bool {
        return isset($this->data[$offset]);
    }

    /**
     * @param mixed $offset
     * @return mixed
     */
    public function offsetGet ($offset) {
        return $this->data[$offset] ?? null;
    }

    /**
     * @param mixed $offset
     * @param mixed $value
     */
    public function offsetSet ($offset, $value): void {
        $this->data[$offset] = $value;
        $this->diff[$offset] = true;
    }

    /**
     * @param mixed $offset
     */
    public function offsetUnset ($offset): void {
        unset($this->data[$offset]);
        $this->diff[$offset] = true;
    }

}