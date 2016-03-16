<?php

namespace Fadion\Sanitizer;

class Sanitizer
{
    use Filters;

    /**
     * Execute the sanitizer.
     *
     * @param array $inputs
     * @param array $sanitizers
     * @return array
     * @throws InvalidSanitizerException
     */
    public function run($inputs, $sanitizers)
    {
        foreach ($sanitizers as $input => $sanitizer) {
            $rules = $this->flatten($sanitizer);

            if (count($rules) and isset($inputs[$input])) {
                foreach ($rules as $rule) {
                    list($rule, $argument) = $this->extractArgument($rule);
                    $method = $this->methodName($rule);

                    if (! method_exists($this, $method)) {
                        throw new Exceptions\InvalidSanitizerException;
                    }

                    $inputs[$input] = $this->$method($inputs[$input], $argument);
                }
            }
        }

        return $inputs;
    }

    /**
     * Transform rules into an array.
     *
     * @param array|string $rules
     * @return array
     */
    protected function flatten($rules)
    {
        if (! is_array($rules)) {
            return explode('|', $rules);
        }

        return $rules;
    }

    /**
     * Extract the rule and argument.
     *
     * @param string $rule
     * @return array
     */
    protected function extractArgument($rule)
    {
        $argument = null;

        if (strpos($rule, ':') !== false) {
            list($rule, $argument) = explode(':', $rule);
        }

        return [$rule, $argument];
    }

    /**
     * Build the filter method name.
     *
     * @param string $rule
     * @return string
     */
    protected function methodName($rule)
    {
        return 'filter_'.strtolower(trim($rule));
    }
}
