<?php
declare(strict_types=1);

use function adityasetiono\util\{
    filter_params
};

class FilterParamsTest extends \PHPUnit\Framework\TestCase
{
    private $required = ['id', 'type', 'location', 'manufacturer', 'year'];
    private $params = [
        'id' => 'a',
        'type' => 'b',
        'location' => 'c',
        'manufacturer' => 'd',
        'year' => 'e'
    ];

    /** @test */
    public function testEmpty()
    {
        $required = [];
        $params = [];

        $expected = [];

        $this->assertEquals($expected, filter_params($required, $params));
    }

    /** @test */
    public function testParamsEmpty()
    {
        $required = $this->required;
        $params = [];

        $expected = [];

        $this->assertEquals($expected, filter_params($required, $params));
    }

    /** @test */
    public function testRequiredEmpty()
    {
        $required = [];
        $params = ['id' => 'a'];

        $expected = [];

        $this->assertEquals($expected, filter_params($required, $params));
    }

    /** @test */
    public function testValidUsecase()
    {
        $required = $this->required;
        $params = $this->params;

        $expected = $params;

        $this->assertEquals($expected, filter_params($required, $params));
    }

    /** @test */
    public function testValidUsecase2()
    {
        $required = $this->required;
        $params = [
            'id' => 'a',
            'type' => 'b',
            'location' => 'c',
            'manufacturer' => 'd',
            'year' => 'e',
            'foo' => 'f',
            'bar' => 'g'
        ];

        $expected = $this->params;

        $this->assertEquals($expected, filter_params($required, $params));
    }
}