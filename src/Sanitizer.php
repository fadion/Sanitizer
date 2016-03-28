<?php

namespace Fadion\Sanitizer;

use Closure;
use BadFunctionCallException;
use Fadion\Sanitizer\Exceptions\InvalidSanitizerException;

class Sanitizer
{
    use Filters;

    /**
    * @var array
    */
    protected static $customSanitizers = [];

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
                    // Closure sanitizer
                    if ($this->isClosure($rule)) {
                        $inputs[$input] = $rule($inputs[$input]);
                    }
                    // Custom sanitizer
                    else if (isset(static::$customSanitizers[$rule])) {
                        $customSanitizer = static::$customSanitizers[$rule];

                        if (! $this->isClosure($customSanitizer)) {
                            throw new BadFunctionCallException;
                        }

                        $inputs[$input] = $customSanitizer($inputs[$input]);
                    }
                    // Predefined sanitizer
                    else {
                        list($rule, $argument) = $this->extractArgument($rule);
                        $method = $this->methodName($rule);

                        if (! method_exists($this, $method)) {
                            throw new InvalidSanitizerException;
                        }

                        $inputs[$input] = $this->$method($inputs[$input], $argument);
                    }
                }
            }
        }

        return $inputs;
    }

    /**
     * Register custom sanitizer.
     *
     * @param string $name
     * @param closure $closure
     * @return array
     */
    public static function register($name, $closure)
    {
        static::$customSanitizers[$name] = $closure;
    }

    /**
     * Transform rules into an array.
     *
     * @param mixed $rules
     * @return array
     */
    protected function flatten($rules)
    {
        if (! is_array($rules)) {
            return ($this->isClosure($rules)) ? [$rules] : explode('|', $rules);
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

    /**
     * Tests if a value is a closure.
     *
     * @param mixed $closure
     * @return bool
     */
    protected function isClosure($closure)
    {
        return $closure instanceof Closure;
    }
}
