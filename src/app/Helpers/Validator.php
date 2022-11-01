<?php

namespace SiddhiAppointments\App\Helpers;

use SiddhiAppointments\App\Exceptions\ValidationException;

class Validator
{
    private $supportedRules = [
        'required' => 'required\|',
        'string' => 'string\|',
        'int' => 'int\|',
        'array' => 'array\|',
        'max' => 'max:(.+?\|)',
        'regex' => 'regex:(.*(?=\|required|string|int|array|max|dummy))',
    ];

    private $errors = [];
    private $errorMessages = [
        'required' => 'This field is required.',
        'string' => 'The field must be a string.',
        'int' => 'The field must be an integer.',
        'array' => 'The field must be an array.',
        'max' => 'The field must be of maximum length max_length.',
        'regex' => 'The value does not match the regex pattern.'
    ];

    /**
     * Throw exception if validation rule is not supported.
     *
     * @param  string $method
     * @param  array $args
     * @throws \Exception Throws exception for the unsupported validation rules.
     * @return void
     */
    public function __call( $method, $args )
    {
        $method = strtolower( str_replace( 'validate', '', $method ) );
        throw new \Exception( "The validation rule '". $method ."' is not supported." );
    }

    private function parseValidationRules( string $rule )
    {
        $rule .= '|dummy';
        $regex = '';
        foreach ( $this->supportedRules as $supportedRule ) {
            $regex .= $supportedRule . '|';
        }
        $regex = rtrim( $regex, '|' );
        $regex = '('. $regex .')';

        preg_match_all( '/' . $regex . '/', $rule, $matchedRules );

        foreach ( $matchedRules[0] as &$matchedRule ) {
            $matchedRule = rtrim( $matchedRule, '|' );
        }
        return $matchedRules[0];
    }

    private function getFieldValue( $data, $field )
    {
        $fieldKeys = explode( '.', $field );

        $value = $data;
        foreach ( $fieldKeys as $fieldKey ) {
            $value = $value[$fieldKey] ?? NULL;

            if ( is_null( $value ) ) {
                return $value;
                break;
            }
        }

        return $value;
    }

    private function updateErrors( string $field, string $message )
    {
        $fieldKeys = explode( '.', $field );

        $error = $message;
        foreach ( array_reverse( $fieldKeys ) as $fieldKey ) {
            // Except for the last key
            if ( $fieldKeys[0] != $fieldKey ) {
                $error = array($fieldKey => $error);
            }
        }

        $this->errors[$fieldKeys[0]] = $error;
    }

    /**
     * Performs data validation based on provided rules.
     *
     * @param array $data
     * @param array $rules
     * @throws ValidationException
     * @return boolean
     */
    public function validate( array $data, array $rules )
    {
        foreach ( $rules as $field => $rule ) {
            $validatorRules = $this->parseValidationRules($rule);

            foreach ( $validatorRules as $validatorRule ) {
                $ruleArgs = preg_split( '/:/', $validatorRule, 2 );
                $condition = $ruleArgs[1] ?? 0;

                $method = 'validate' . ucfirst( $ruleArgs[0] );
                $value = $this->getFieldValue( $data, $field );
                $validated = $this->$method( $field, $value, $condition );

                if ( ! $validated ) {
                    break;
                }
            }
        }

        if ( ! empty( $this->errors ) ) {
            throw new ValidationException( $this->errors );
        }

        return true;
    }

    /**
     * Validates 'required' rule.
     *
     * @param string $field Field name under validation.
     * @param mixed $value Field value
     * @return boolean
     */
    private function validateRequired( $field, $value='' )
    {
        if ( empty( $value ) ) {
            $this->updateErrors( $field, $this->errorMessages['required'] );
            return false;
        }
        return true;
    }

    /**
     * Validates 'string' rule.
     *
     * @param string $field Field name under validation.
     * @param mixed $value Field value
     * @return boolean
     */
    private function validateString( $field, $value='' )
    {
        if ( ! is_string( $value ) ) {
            $this->updateErrors( $field, $this->errorMessages['string'] );
            return false;
        }
        return true;
    }

    /**
     * Validates 'int' rule.
     *
     * @param string $field Field name under validation.
     * @param mixed $value Field value
     * @return boolean
     */
    private function validateInt( $field, $value='' )
    {
        if ( ! is_int( $value ) ) {
            $this->updateErrors( $field, $this->errorMessages['int'] );
            return false;
        }
        return true;
    }

    /**
     * Validates 'array' rule.
     *
     * @param string $field Field name under validation.
     * @param mixed $value Field value
     * @return boolean
     */
    private function validateArray( $field, $value='' )
    {
        if ( ! is_array( $value ) ) {
            $this->updateErrors( $field, $this->errorMessages['array'] );
            return false;
        }
        return true;
    }

    /**
     * Validates 'max' rule.
     *
     * @param string $field Field name under validation.
     * @param mixed $value Field value
     * @param int $maxLength Maximum length for the validation.
     * @return boolean
     */
    private function validateMax( $field, $value='', $maxLength=0 )
    {
        if ( strlen( $value ) > $maxLength ) {
            $this->updateErrors( $field, str_replace( 'max_length', $maxLength, $this->errorMessages['max']) );
            return false;
        }
        return true;
    }

    /**
     * Validates 'max' rule.
     *
     * @param string $field Field name under validation.
     * @param mixed $value Field value
     * @param string $pattern Regex pattern string.
     * @return boolean
     */
    private function validateRegex( $field, $value='', string $pattern )
    {
        if ( empty( $pattern ) ) {
            return false;
        }

        if ( ! preg_match( "/$pattern/", $value ) ) {
            $this->updateErrors( $field, $this->errorMessages['regex'] );
            return false;
        }
        return true;
    }
}