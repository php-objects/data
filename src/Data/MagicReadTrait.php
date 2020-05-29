<?php

namespace Base\Data;

use Base\Data;

/**
 * Provides read-only field access as magic properties.
 *
 * This also allows things like `array_column()` to fetch from the object.
 *
 * @mixin Data
 */
trait MagicReadTrait {

    /**
     * @param string $field
     * @return null|mixed
     */
    public function __get (string $field) {
        return $this->data[$field] ?? null;
    }

    /**
     * @param string $field
     * @return bool
     */
    public function __isset (string $field): bool {
        return isset($this->data[$field]);
    }
}