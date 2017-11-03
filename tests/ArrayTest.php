<?php
declare(strict_types=1);

use function adityasetiono\util\{
    check_params, filter_params, pluck
};

class ArrayTest extends \PHPUnit\Framework\TestCase
{
    /** @test */
    public function testEmpty()
    {
        $required = ['one', 'two', 'three'];
        $params = [];

        $this->assertEquals(false, check_params($required, $params));
    }

    /** @test */
    public function testIntegerKeys()
    {
        $required = [1, 2, 3];
        $params = [1, 2, 3];

        $this->assertEquals(false, check_params($required, $params));
    }

    /** @test */
    public function testIntegerKeys2()
    {
        $required = [1, 2, 3];
        $params = [1 => 1, 2 => 2, 3 => 3];

        $this->assertEquals(true, check_params($required, $params));
    }

    /** @test */
    public function testStringKeys()
    {
        $required = ['one', 'two', 'three'];
        $params = ['one' => 1, 'two' => 2, 'three' => 3];

        $this->assertEquals(true, check_params($required, $params));
    }

    /** @test */
    public function testNull()
    {
        $required = ['one', 'two', 'three'];
        $params = null;

        $this->assertEquals(false, check_params($required, $params));
    }

    /** @test */
    public function testRequiredNull()
    {
        $required = null;
        $params = ['one' => 1, 'two' => 2, 'three' => 3];

        $this->expectException(TypeError::class);
        check_params($required, $params);
    }

    /** @test */
    public function testRequiredEmpty()
    {
        $required = [];
        $params = ['one' => 1, 'two' => 2, 'three' => 3];

        $this->assertEquals(true, check_params($required, $params));
    }
}
