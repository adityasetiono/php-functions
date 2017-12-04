<?php
declare(strict_types=1);

use function adityasetiono\util\{
    deserialize
};
use adityasetiono\tests\entity\{
    App, Device, Location
};

class DeserializerTest extends PHPUnit\Framework\TestCase
{
    private $id = 'id1';
    private $type = 'ANDROID';
    private $lat = 12.34;
    private $long = 34.56;
    private $manufacturer = 'OnePlus';
    private $year = 2017;
    private $appname = 'gmail';

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

    private function getDefaultLocation()
    {
        return [
            'location' => [
                'lat' => $this->lat,
                'long' => $this->long
            ]
        ];
    }

    private function getDefaultDevice()
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

    private function getDefaultApp()
    {
        return ['name' => $this->appname];
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

    private function getDefaultAppObject(): App
    {
        $app = new App();
        $app->setName($this->appname);

        return $app;
    }

    /** @test */
    public function testDefault()
    {
        $device = $this->getDefaultDeviceObject();
        $arrDevice = $this->getDefaultDevice();
        $this->assertEquals($arrDevice, deserialize($device, [
            'id' => 'id',
            'type' => 'type',
            'location' => 'location',
            'manufacturer' => 'manufacturer',
            'year' => 'year'
        ]));
    }

    /** @test */
    public function testArray()
    {
        $device = $this->getDefaultDeviceObject();
        $app = $this->getDefaultAppObject();
        $apps = [$app, $app, $app];
        $device->setApps($apps);
        $devices = [$device, $device, $device];
        $arrApp = $this->getDefaultApp();
        $arrApps = [$arrApp, $arrApp, $arrApp];
        $arrDevice = $this->getDefaultDevice();
        $arrDevice['apps'] = $arrApps;
        $arrDevices = [$arrDevice, $arrDevice, $arrDevice];
        $actual = deserialize($devices, [
            'id' => 'id',
            'type' => 'type',
            'location' => 'location',
            'manufacturer' => 'manufacturer',
            'year' => 'year',
            'apps' => [
                '__field' => 'apps',
                'name' => 'name'
            ]
        ]);
        $this->assertEquals($arrDevices, $actual);
    }
}
