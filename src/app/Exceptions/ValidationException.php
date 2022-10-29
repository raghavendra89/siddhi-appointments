<?php

namespace SiddhiAppointments\App\Exceptions;

class ValidationException extends \Exception
{
    private $errors = [];

    public function __construct( array $errors = [] )
    {
        parent::__construct('The given data was invalid.');

        $this->errors = $errors;
    }

    public function errors()
    {
        return $this->errors;
    }
}