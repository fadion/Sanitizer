<?php

require_once 'vendor/autoload.php';

$inputs = ['name' => 'fadion', 'surname' => 'dashi'];
$sanitizers = ['name' => 'trim|ucfirst', 'surname' => 'trim|upper'];

$sanitizer = new Fadion\Sanitizer\Sanitizer;

print_r($sanitizer->run($inputs, $sanitizers));
