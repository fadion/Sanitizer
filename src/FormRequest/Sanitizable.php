<?php

namespace Fadion\Sanitizer\FormRequest;

use Fadion\Sanitizer\Sanitizer;

trait Sanitizable
{
    /**
     * Override FormRequest's all() method
     * to sanitize and return back the inputs.
     *
     * @return array
     */
    public function all()
    {
        $inputs = parent::all();

        if (method_exists($this, 'sanitizers') and
            is_array($this->sanitizers()) and
            count($this->sanitizers())
        ) {
            $sanitizer = new Sanitizer;
            $inputs = $sanitizer->run($inputs, $this->sanitizers());
        }

        return $inputs;
    }
}
