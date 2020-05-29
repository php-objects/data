<?php

namespace Base\Data;

use Base\Data;

/**
 * @mixin Data
 */
trait CountableTrait {

    /**
     * @return int
     */
    public function count (): int {
        return count($this->data);
    }
}