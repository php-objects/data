<?php

namespace Base\Data;

use Base\Data;

/**
 * @mixin Data
 */
trait SerializableTrait {

    /**
     * @return string
     */
    public function serialize (): string {
        return serialize($this->toArray());
    }

    /**
     * @param $serialized
     */
    public function unserialize ($serialized) {
        $this->data = unserialize($serialized);
    }

}