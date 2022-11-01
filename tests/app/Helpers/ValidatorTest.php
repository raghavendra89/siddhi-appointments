<?php

namespace Tests;

use SiddhiAppointments\App\Exceptions\ValidationException;
use SiddhiAppointments\App\Helpers\Validator;
use Tests\TestCase;

class ValidatorTest extends TestCase
{
    /** @test */
    public function it_throws_validation_exception()
    {
        $this->expectException( ValidationException::class );
        $data = [];
        $rules = ['name' => 'required'];

        $validator = new Validator();
        $validator->validate( $data, $rules );
    }

    /** @test */
    public function it_igonres_rules_which_do_not_exist()
    {
        $data = [];
        $rules = ['name' => 'dummy'];

        $validator = new Validator();
        $result = $validator->validate( $data, $rules );
        $this->assertTrue($result);
    }

    /** @test */
    public function it_validates_required_rule()
    {
        $data = [];
        $rules = ['name' => 'required'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'name' => 'This field is required.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_validates_string_rule()
    {
        $data = ['name' => 6562];
        $rules = ['name' => 'string'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'name' => 'The field must be a string.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_validates_int_rule()
    {
        $data = ['count' => 'string'];
        $rules = ['count' => 'int'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'count' => 'The field must be an integer.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_validates_array_rule()
    {
        $data = ['info' => 'string'];
        $rules = ['info' => 'array'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'info' => 'The field must be an array.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_validates_max_rule()
    {
        $data = ['name' => 'This is a long string.'];
        $rules = ['name' => 'max:10'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'name' => 'The field must be of maximum length 10.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_validates_regex_rule()
    {
        $data = ['phone_number' => '999-999-99'];
        $rules = ['phone_number' => 'regex:\d{3}-\d{3}-\d{4}'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'phone_number' => 'The value does not match the regex pattern.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_validates_regex_rule_1()
    {
        $data = ['start_time' => '10:00'];
        $rules = ['start_time' => 'regex:([0-1]\d|2[0-3]):[0-5]\d$'];

        $validator = new Validator();
        $result = $validator->validate( $data, $rules );
        $this->assertTrue($result);
    }

    /** @test */
    public function it_validates_multiple_rules()
    {
        $data = ['name' => 'John'];
        $rules = ['name' => 'string|max:3'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'name' => 'The field must be of maximum length 3.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_validates_multiple_rules_1()
    {
        $data = [];
        $rules = ['name' => 'required|string'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'name' => 'This field is required.'
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function it_performs_validation_of_nested_data()
    {
        $data = [
            'basic_details' => [
                'name' => 'John'
            ]
        ];
        $rules = ['basic_details.name' => 'required'];

        $validator = new Validator();
        $result = $validator->validate( $data, $rules );

        $this->assertTrue($result);
    }

    /** @test */
    public function validation_of_nested_data_throws_nested_error_messages()
    {
        $data = [
            'basic_details' => [
                'name' => 'John'
            ]
        ];
        $rules = ['basic_details.email_address' => 'required'];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'basic_details' => [
                    'email_address' => 'This field is required.'
                ]
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }

    /** @test */
    public function validation_of_nested_data_throws_nested_error_messages_1()
    {
        $data = [
            'basic_details' => [
                'name' => 'John'
            ],
            'time_slots' => [
                'slot_duration' => 'string'
            ]
        ];
        $rules = [
            'basic_details.email_address' => 'required',
            'time_slots.slot_duration' => 'required|int'
        ];

        $validator = new Validator();
        try {
            $validator->validate( $data, $rules );
        } catch ( ValidationException $e ) {
            $errors = [
                'basic_details' => [
                    'email_address' => 'This field is required.'
                ],
                'time_slots' => [
                    'slot_duration' => 'The field must be an integer.'
                ]
            ];

            $this->assertSame( $errors, $e->errors() );
        }
    }
}