<?php
declare(strict_types=1);

namespace adityasetiono\tests\entity;

class Device
{
    protected $id;
    protected $type;
    protected $location;
    protected $manufacturer;
    protected $year;
    protected $apps;

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Device
    {
        $this->id = $id;

        return $this;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function setType(string $type): Device
    {
        $this->type = $type;

        return $this;
    }

    public function getLocation(): Location
    {
        return $this->location;
    }

    public function setLocation(Location $location): Device
    {
        $this->location = $location;

        return $this;
    }

    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(string $manufacturer): Device
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getYear(): int
    {
        return $this->year;
    }

    public function setYear(int $year): Device
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return App[]|null|array
     */
    public function getApps()
    {
        return $this->apps;
    }

    public function setApps($apps): Device
    {
        $this->apps = $apps;

        return $this;
    }
}