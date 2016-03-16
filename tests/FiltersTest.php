<?php

use Fadion\Sanitizer\Filters;

class FiltersTest extends PHPUnit_Framework_TestCase
{
    use Filters;

    public function test_trim()
    {
        return $this->assertEquals('john', $this->filter_trim(' john '));
    }

    public function test_ltrim()
    {
        return $this->assertEquals('john ', $this->filter_ltrim(' john '));
    }

    public function test_rtrim()
    {
        return $this->assertEquals(' john', $this->filter_rtrim(' john '));
    }

    public function test_md5()
    {
        return $this->assertEquals(md5('john'), $this->filter_md5('john'));
    }

    public function test_sha1()
    {
        return $this->assertEquals(sha1('john'), $this->filter_sha1('john'));
    }

    public function test_urlencode()
    {
        return $this->assertEquals('john+smith', $this->filter_urlencode('john smith'));
    }

    public function test_urldecode()
    {
        return $this->assertEquals('john smith', $this->filter_urldecode('john+smith'));
    }

    public function test_strip_tags()
    {
        return $this->assertEquals('<p>john</p>', $this->filter_strip_tags('<p>john<iframe></p>'));
    }

    public function test_htmlentities()
    {
        return $this->assertEquals('john &amp; smith', $this->filter_htmlentities('john & smith'));
    }

    public function test_base64_encode()
    {
        return $this->assertEquals('am9obg==', $this->filter_base64_encode('john'));
    }

    public function test_base64_decode()
    {
        return $this->assertEquals('john', $this->filter_base64_decode('am9obg=='));
    }

    public function test_lcfirst()
    {
        return $this->assertEquals('jOHN', $this->filter_lcfirst('JOHN'));
    }

    public function test_ucfirst()
    {
        return $this->assertEquals('John', $this->filter_ucfirst('john'));
    }

    public function test_ucwords()
    {
        return $this->assertEquals('John Smith', $this->filter_ucwords('john smith'));
    }

    public function test_strtoupper()
    {
        return $this->assertEquals('JOHN', $this->filter_strtoupper('john'));
    }

    public function test_upper()
    {
        return $this->assertEquals('JOHN', $this->filter_upper('john'));
    }

    public function test_strtolower()
    {
        return $this->assertEquals('john', $this->filter_strtolower('JOHN'));
    }

    public function test_lower()
    {
        return $this->assertEquals('john', $this->filter_lower('JOHN'));
    }

    public function test_nl2br()
    {
        return $this->assertEquals("john<br />\nsmith", $this->filter_nl2br("john\nsmith"));
    }

    public function test_date()
    {
        return $this->assertEquals('12/12/2012', $this->filter_date('2012-12-12', 'm/d/Y'));
    }

    public function test_number_format()
    {
        return $this->assertEquals('100.3', $this->filter_number_format('100.30', 1));
        return $this->assertEquals('100', $this->filter_number_format('100.30'));
    }

    public function test_sanitize_email()
    {
        return $this->assertEquals('testuser@gmail.com', $this->filter_sanitize_email('test>user@"gmail.com'));
    }

    public function test_sanitize_string()
    {
        return $this->assertEquals('john&#34; &#34;smith', $this->filter_sanitize_string('<p>john" "smith</p>'));
    }

    public function test_sanitize_url()
    {
        return $this->assertEquals('http://nonexistanturl.com/web', $this->filter_sanitize_url('http://nonexistanturl.com/¢™web'));
    }

    public function test_limit()
    {
        return $this->assertEquals('some ...', $this->filter_limit('some long text', 5));
    }

    public function test_mask()
    {
        return $this->assertEquals('*******ith', $this->filter_mask('john smith'));
        return $this->assertEquals('@@@@@@@ith', $this->filter_mask('john smith', '@'));
    }

    public function test_alpha()
    {
        return $this->assertEquals('jhnsmth', $this->filter_alpha('j0hn@sm1th'));
    }

    public function test_alphanumeric()
    {
        return $this->assertEquals('johnsm1th', $this->filter_alphanumeric('john@"sm1th"'));
    }

    public function test_numeric()
    {
        return $this->assertEquals('123', $this->filter_numeric('abc123def'));
    }

    public function test_int()
    {
        return $this->assertEquals(12, $this->filter_int('12'));
    }

    public function test_float()
    {
        return $this->assertEquals(12.3, $this->filter_float('12.3'));
    }

    public function test_bool()
    {
        return $this->assertEquals(false, $this->filter_bool('0'));
    }
}
