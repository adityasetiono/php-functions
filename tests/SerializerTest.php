<?php
declare(strict_types=1);

use function adityasetiono\util\{
    serialize
};
use adityasetiono\tests\entity\{
    Device, Location
};

class SerializerTest extends PHPUnit\Framework\TestCase
{
    private $id = 'id1';
    private $type = 'ANDROID';
    private $lat = 12.34;
    private $long = 34.56;
    private $manufacturer = 'OnePlus';
    private $year = 2017;

    private function getDefaultInput()
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'location' => [
                'lat' => $this->lat,
                'long' => $this->long
            ],
            'manufacturer' => $this->manufacturer,
            'year' => $this->year
        ];
    }

    private function getDefaultLocationObject(): Location
    {
        $location = new Location();
        $location->setLat($this->lat)
            ->setLong($this->long);

        return $location;
    }

    private function getDefaultDeviceObject(): Device
    {
        $location = $this->getDefaultLocationObject();

        $device = new Device();
        $device->setId($this->id)
            ->setType($this->type)
            ->setLocation($location)
            ->setManufacturer($this->manufacturer)
            ->setYear($this->year);

        return $device;
    }

    /** @test */
    public function testEmpty()
    {
        $input = [];

        $device = new Device();
        $this->assertEquals($device, serialize($input, Device::class));
    }

    /** @test */
    public function testNormalUsecase()
    {
        $input = $this->getDefaultInput();
        $expected = $this->getDefaultDeviceObject();

        $this->assertEquals($expected, serialize($input, Device::class));
    }

    /** @test */
    public function testSetObject()
    {
        $location = $this->getDefaultLocationObject();
        $expected = $this->getDefaultDeviceObject();

        $input = $this->getDefaultInput();
        $input['location'] = $location;

        $this->assertEquals($expected, serialize($input, Device::class));
    }

    /** @test */
    public function testUpdate()
    {
        $input = ['year' => 2016];
        $initial = $this->getDefaultDeviceObject();
        $expected = $this->getDefaultDeviceObject();
        $expected->setYear(2016);

        $this->assertEquals($expected, serialize($input, Device::class, $initial));
    }

    /** @test */
    public function testUpdateObject()
    {
        $input = [
            'location' => [
                'lat' => 99.99,
                'long' => 100.55
            ]
        ];
        $initial = $this->getDefaultDeviceObject();
        $location = new Location();
        $location->setLat(99.99)
            ->setLong(100.55);
        $expected = $this->getDefaultDeviceObject();
        $expected->setLocation($location);

        $this->assertEquals($expected, serialize($input, Device::class, $initial));
    }

    /** @test */
    public function testNull()
    {
        $input = null;
        $expected = new Device();

        $this->assertEquals($expected, serialize($input, Device::class));
    }

    /** @test */
    public function testEmptyArray()
    {
        $input = [];
        $expected = new Device();

        $this->assertEquals($expected, serialize($input, Device::class));
    }

    /** @test */
    public function testInvalidParamType()
    {
        $input = 'param';
        $expected = new Device();

        $this->assertEquals($expected, serialize($input, Device::class));
    }

    /** @test */
    public function testNullInnerclass()
    {
        $input = $this->getDefaultInput();
        $input['location'] = null;
        $expected = new Device();
        $expected->setId($this->id)
            ->setType($this->type)
            ->setManufacturer($this->manufacturer)
            ->setYear($this->year);

        $this->assertEquals($expected, serialize($input, Device::class));
    }


    /** @test */
    public function testEmptyInnerclass()
    {
        $input = $this->getDefaultInput();
        $input['location'] = [];
        $expected = $this->getDefaultDeviceObject();
        $expected->setLocation(new Location());

        $this->assertEquals($expected, serialize($input, Device::class));
    }
}
