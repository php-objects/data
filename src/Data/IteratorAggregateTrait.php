<?php

namespace Base\Data;

use ArrayIterator;
use Base\Data;
use Traversable;

/**
 * @mixin Data
 */
trait IteratorAggregateTrait {

    /**
     * @return Traversable
     */
    public function getIterator () {
        return new ArrayIterator($this->data);
    }
}