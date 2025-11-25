<?php

namespace Http\Forms;

use Core\ValidationException;
use Core\Validator;

class LoginForm
{
    protected $errors = [];

    public function __construct(public array $attributes) {
        if (!Validator::email($attributes['email'])) {
            $this->errors['email'] = "A valid email address is required";
        }

        if (!Validator::string($attributes['password'], 7, 40)) {
            $this->errors['password'] = "A password of between 7 and 40 characters is required";
        }
    }

    public static function validate($attributes)
    {
        $instance = new static($attributes);

        return $instance->failed() ? $instance->throw() : $instance;
    }

    /**
     * @throws ValidationException
     */
    public function throw()
    {
        ValidationException::throw($this->errors(), $this->attributes);
    }

    public function failed()
    {
        return count($this->errors);
    }

    public function errors()
    {
        return $this->errors;
    }

    public function error($field, $message)
    {
        $this->errors[$field] = $message;

        return $this;
    }
}