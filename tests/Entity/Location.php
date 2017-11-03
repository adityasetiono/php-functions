<?php
declare(strict_types=1);

namespace adityasetiono\tests\entity;

class Location
{
    protected $lat;
    protected $long;

    public function getLat(): float
    {
        return $this->lat;
    }

    public function setLat(float $lat): Location
    {
        $this->lat = $lat;

        return $this;
    }

    public function getLong(): float
    {
        return $this->long;
    }

    public function setLong(float $long): Location
    {
        $this->long = $long;

        return $this;
    }

}