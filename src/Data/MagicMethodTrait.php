<?php

namespace Base\Data;

use Base\Data;

/**
 * @mixin Data
 */
trait MagicMethodTrait {

    /**
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call (string $method, array $args) {
        static $magic = [];
        if (!$call =& $magic[$method]) {
            preg_match('/^(get|has|is|set)(.+)$/', $method, $call);
            $call[1] = '_' . $call[1];
            $call[2] = preg_replace_callback('/[A-Z]/', function(string $letter) {
                return '_' . strtolower($letter);
            }, lcfirst($call[2]));
        }
        return $this->{$call[1]}($call[2], ...$args);
    }

    /**
     * @param string $field
     * @return mixed
     */
    public function __get (string $field) {
        return $this->_get($field);
    }

    /**
     * @param string $field
     * @return bool
     */
    public function __isset (string $field): bool {
        return $this->_is($field);
    }

    /**
     * Getter with default.
     *
     * @param string $field
     * @param mixed $default
     * @return mixed
     */
    protected function _get (string $field, $default = null) {
        return $this->data[$field] ?? $default;
    }

    /**
     * Whether a countable field has anything in it, or boolean cast of scalar field.
     *
     * @param string $field
     * @return bool
     */
    protected function _has (string $field): bool {
        $value = $this->_get($field);
        if (isset($value)) {
            if (is_countable($value)) {
                return count($value) > 0;
            }
            return (bool)$value;
        }
        return false;
    }

    /**
     * Boolean cast.
     *
     * @param string $field
     * @return bool
     */
    public function _is (string $field): bool {
        return (bool)$this->_get($field);
    }

    /**
     * Fluent setter.
     *
     * @param string $field
     * @param mixed $value
     * @return $this
     */
    protected function _set (string $field, $value) {
        $this->data[$field] = $value;
        $this->diff[$field] = true;
        return $this;
    }
}