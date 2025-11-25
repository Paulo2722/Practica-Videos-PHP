<?php

namespace Core;

class ValidationException extends \Exception
{
    public readonly array $errors;
    public readonly array $old;

    /**
     * @throws ValidationException
     */
    public static function throw($errors, $old)
    {
        $instance = new static('Form failed to validate.');

        $instance->errors = $errors;
        $instance->old = $old;

        throw $instance;
    }
}