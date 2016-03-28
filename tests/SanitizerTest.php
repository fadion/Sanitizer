<?php

use Fadion\Sanitizer\Sanitizer;

class SanitizerTest extends PHPUnit_Framework_TestCase
{
    public function test_sanitize_inputs()
    {
        $inputs = [
            'name' => ' john',
            'surname' => 'smith '
        ];
        $sanitizers = [
            'name' => 'trim|ucfirst',
            'surname' => ['trim', 'upper']
        ];

        $expected = [
            'name' => 'John',
            'surname' => 'SMITH'
        ];

        $sanitizer = new Sanitizer;

        $this->assertEquals($expected, $sanitizer->run($inputs, $sanitizers));
    }

    public function test_invalid_sanitizer()
    {
        $this->expectException(Fadion\Sanitizer\Exceptions\InvalidSanitizerException::class);

        $inputs = ['name' => 'john'];
        $sanitizers = ['name' => 'invalid_filter'];

        $sanitizer = new Sanitizer;
        $sanitizer->run($inputs, $sanitizers);
    }

    public function test_no_sanitizers()
    {
        $inputs = [
            'name' => ' john',
            'surname' => 'smith '
        ];
        $sanitizers = [];

        $sanitizer = new Sanitizer;

        $this->assertEquals($inputs, $sanitizer->run($inputs, $sanitizers));
    }

    public function test_sanitizer_with_argument()
    {
        $inputs = ['registered_at' => '2012-12-12'];
        $sanitizers = ['registered_at' => 'date:m/d/Y'];
        $expected = ['registered_at' => '12/12/2012'];

        $sanitizer = new Sanitizer;

        $this->assertEquals($expected, $sanitizer->run($inputs, $sanitizers));
    }

    public function test_closure_sanitizer()
    {
        $inputs = [
            'name' => 'john ',
            'surname' => 'Smith'
        ];
        $sanitizers = [
            'name' => ['trim', function($value) {
                return ucfirst($value);
            }],
            'surname' => function($value) {
                return str_replace('Smith', 'Cena', $value);
            }
        ];

        $expected = [
            'name' => 'John',
            'surname' => 'Cena'
        ];

        $sanitizer = new Sanitizer;

        $this->assertEquals($expected, $sanitizer->run($inputs, $sanitizers));
    }
}
