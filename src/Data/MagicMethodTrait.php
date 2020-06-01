<?php

namespace Base\Data;

use Base\Data;

/**
 * Autowires magic methods to real methods.
 *
 * Magic methods should be annotated in your classes, though this does not require that.
 *
 * @mixin Data
 */
trait MagicMethodTrait {

    /**
     * Forwards `->xyzFieldName123(...$args)` to `->_xyz('field_name123', ...$args)`
     *
     * @param string $method
     * @param array $args
     * @return mixed
     */
    public function __call (string $method, array $args) {
        static $magic = [];
        if (!$call =& $magic[$method]) {
            preg_match('/^([a-z]+)(.+)$/', $method, $call);
            $call[1] = '_' . $call[1];
            $call[2] = preg_replace_callback('/[A-Z]/', function(array $match) {
                return '_' . lcfirst($match[0]);
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
     * Example: `getFoo($default = null)`
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
     * Example: `hasFoo()`
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
     * Example: `isFoo()`
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
     * Example: `setFoo($foo)`
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