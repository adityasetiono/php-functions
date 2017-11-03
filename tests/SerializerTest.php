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

    private function getDefaultLocationObject()
    {
        $location = new Location();
        $location->setLat($this->lat);
        $location->setLong($this->long);

        return $location;
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

        $location = new Location();
        $location->setLat($this->lat);
        $location->setLong($this->long);

        $expected = new Device();
        $expected->setId($this->id)
            ->setType($this->type)
            ->setLocation($location)
            ->setManufacturer($this->manufacturer)
            ->setYear($this->year);

        $this->assertEquals($expected, serialize($input, Device::class));
    }

    /** @test */
    public function testSetObject()
    {
        $location = $this->getDefaultLocationObject();
        $expected = new Device();
        $expected->setId($this->id)
            ->setType($this->type)
            ->setLocation($location)
            ->setManufacturer($this->manufacturer)
            ->setYear($this->year);

        $input = $this->getDefaultInput();
        $input['location'] = $location;

        $this->assertEquals($expected, serialize($input, Device::class));

    }
}
