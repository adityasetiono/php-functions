<?php
declare(strict_types=1);

use function adityasetiono\util\{
    validate_phone_number,
    obfuscate_phone_number
};

class PhoneNumberTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function testDefault()
    {
        $number = '0452614575';
        $expected = '+61452614575';
        $actual = validate_phone_number($number, '+61');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testValidateEmptyCountryCode()
    {
        $number = '0452614575';
        $expected = '0452614575';
        $actual = validate_phone_number($number, '0');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testCountryCodeValidate()
    {
        $number = '+61452614575';
        $expected = '+61452614575';
        $actual = validate_phone_number($number, '+61');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testPhoneNumberWithoutZero()
    {
        $number = '452614575';
        $expected = '+61452614575';
        $actual = validate_phone_number($number, '+61');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testNumberWithSpace()
    {
        $number = '0452 614 575';
        $expected = '+61452614575';
        $actual = validate_phone_number($number, '+61');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testWithAlphabet()
    {
        $number = '0452614575a';
        $expected = '+61452614575';
        $actual = validate_phone_number($number, '+61');
        $this->assertEquals($expected, $actual);
    }

    /** @test */
    public function testObfuscate()
    {
        $number = '+61410647557';
        $expected = '+61 XXX XXX 557';
        $actual = obfuscate_phone_number($number);
        $this->assertEquals($expected, $actual);
    }
}