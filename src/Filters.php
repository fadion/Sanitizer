<?php

namespace Fadion\Sanitizer;

trait Filters
{
    /**
     * Trim filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_trim($value, $argument = null)
    {
        return trim($value);
    }

    /**
     * Left Trim filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_ltrim($value, $argument = null)
    {
        return ltrim($value);
    }

    /**
     * Right Trim filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_rtrim($value, $argument = null)
    {
        return rtrim($value);
    }

    /**
     * MD5 filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_md5($value, $argument = null)
    {
        return md5($value);
    }

    /**
     * Sha1 filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_sha1($value, $argument = null)
    {
        return sha1($value);
    }

    /**
     * URL Encode filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_urlencode($value, $argument = null)
    {
        return urlencode($value);
    }

    /**
     * URL Decode filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_urldecode($value, $argument = null)
    {
        return urldecode($value);
    }

    /**
     * Strip Tags filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_strip_tags($value, $argument = null)
    {
        $allowedTags = ['<p>', '<a>', '<b>', '<i>', '<em>', '<strong>', '<img>', '<br>', '<ul>', '<ol>', '<li>', '<span>', '<blockquote>', '<code>', '<sub>', '<sup>', '<h1>', '<h2>', '<h3>', '<h4>', '<h5>', '<h6>', '<dd>', '<dl>', '<label>'];

        return strip_tags($value, implode(null, $allowedTags));
    }

    /**
     * HTMLEntities filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_htmlentities($value, $argument = null)
    {
        return htmlentities($value, ENT_QUOTES, "UTF-8");
    }

    /**
     * Base64 Encode filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_base64_encode($value, $argument = null)
    {
        return base64_encode($value);
    }

    /**
     * Base64 Decode filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_base64_decode($value, $argument = null)
    {
        return base64_decode($value);
    }

    /**
     * Lcfirst filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_lcfirst($value, $argument = null)
    {
        return lcfirst($value);
    }

    /**
     * Ucfirst filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_ucfirst($value, $argument = null)
    {
        return ucfirst($value);
    }

    /**
     * Ucwords filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_ucwords($value, $argument = null)
    {
        return ucwords($value);
    }

    /**
     * Upper filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_strtoupper($value, $argument = null)
    {
        if (extension_loaded('mbstring')) {
            return mb_strtoupper($value);
        }

        return strtoupper($value);
    }

    /**
     * Alias of filter_strtoupper()
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_upper($value, $argument = null)
    {
        return $this->filter_strtoupper($value, $argument);
    }

    /**
     * Lower filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_strtolower($value, $argument = null)
    {
        if (extension_loaded('mbstring')) {
            return mb_strtolower($value);
        }

        return strtolower($value);
    }

    /**
     * Alias of filter_strotolower()
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_lower($value, $argument = null)
    {
        return $this->filter_strtolower($value);
    }

    /**
     * NL2BR filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_nl2br($value, $argument = null)
    {
        return nl2br($value);
    }

    /**
     * Date filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_date($value, $argument = null)
    {
        if ($argument) {
            $value = date($argument, strtotime($value));
        }

        return $value;
    }

    /**
     * Number Format filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_number_format($value, $argument = null)
    {
        if ($argument and is_int($argument)) {
            $value = number_format($value, $argument);
        }

        return $value;
    }

    /**
     * Sanitize email filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_sanitize_email($value, $argument = null)
    {
        return filter_var($value, FILTER_SANITIZE_EMAIL);
    }

    /**
     * Sanitize string filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_sanitize_string($value, $argument = null)
    {
        return filter_var($value, FILTER_SANITIZE_STRING);
    }

    /**
     * Sanitize url filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_sanitize_url($value, $argument = null)
    {
        return filter_var($value, FILTER_SANITIZE_URL);
    }

    /**
     * Limit filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_limit($value, $argument = null)
    {
        if (!isset($argument)) {
            $argument = 20;
        }

        if (strlen($value) > $argument) {
            $value = substr($value, 0, $argument).'...';
        }

        return $value;
    }

    /**
     * Mask filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_mask($value, $argument = null)
    {
        $mask = isset($argument) ? $argument : '*';

        $maskLength = round(strlen($value) * 0.7);

        return str_repeat($mask, $maskLength).substr($value, $maskLength);
    }

    /**
     * Alpha filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_alpha($value, $argument = null)
    {
        return preg_replace("/[^A-Za-z]/", '', $value);
    }

    /**
     * Alphanumeric filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_alphanumeric($value, $argument = null)
    {
        return preg_replace("/[^[:alnum:]]/", '', $value);
    }

    /**
     * Numeric filter
     *
     * @param string $value
     * @param mixed $argument
     * @return string
     */
    protected function filter_numeric($value, $argument = null)
    {
        return preg_replace("/[^0-9]/", '', $value);
    }

    /**
     * Intval filter
     *
     * @param string $value
     * @param mixed $argument
     * @return integer
     */
    protected function filter_int($value, $argument = null)
    {
        return intval($value, $argument);
    }

    /**
     * Floatval filter
     *
     * @param string $value
     * @param mixed $argument
     * @return float
     */
    protected function filter_float($value, $argument = null)
    {
        return floatval($value);
    }

    /**
     * Boolval filter
     *
     * @param string $value
     * @param mixed $argument
     * @return boolean
     */
    protected function filter_bool($value, $argument = null)
    {
        return boolval($value);
    }
}
