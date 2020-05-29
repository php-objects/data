<?php

namespace Base\Data;

use Base\Data;

/**
 * @mixin Data
 */
trait MagicWriteTrait {

    /**
     * @param string $field
     * @param mixed $value
     */
    public function __set (string $field, $value): void {
        $this->data[$field] = $value;
        $this->diff[$field] = true;
    }

    /**
     * @param string $field
     */
    public function __unset (string $field) {
        unset($this->data[$field]);
        $this->diff[$field] = true;
    }
}