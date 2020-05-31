<?php

namespace Base\Data;

use Base\Data;

/**
 * @mixin Data
 */
trait JsonSerializableTrait {

    /**
     * @return array
     */
    public function jsonSerialize (): array {
        $data = $this->toArray();
        ksort($data);
        return $data;
    }
}