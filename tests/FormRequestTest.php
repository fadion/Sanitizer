<?php

use Fadion\Sanitizer\FormRequest\Sanitizable;

class FormRequestTest extends PHPUnit_Framework_TestCase
{
    public function test_sanitize_inputs()
    {
        $formRequest = new UserFormRequest;
        $expected = [
            'name' => 'John',
            'surname' => 'SMITH'
        ];

        $this->assertEquals($expected, $formRequest->all());
    }
}

class FormRequest
{
    public function all()
    {
        return [
            'name' => ' john',
            'surname' => 'smith '
        ];
    }
}

class UserFormRequest extends FormRequest
{
    use Sanitizable;

    public function sanitizers()
    {
        return [
            'name' => 'trim|ucfirst',
            'surname' => ['trim', 'upper']
        ];
    }
}
