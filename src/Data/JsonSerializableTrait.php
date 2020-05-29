<?php

namespace Base\Data;

use Base\Data;
use JsonException;

/**
 * @mixin Data
 */
trait JsonSerializableTrait {

    /**
     * @return string
     * @throws JsonException
     */
    public function jsonSerialize (): string {
        return json_encode($this->data, JSON_PRETTY_PRINT | JSON_THROW_ON_ERROR);
    }
}