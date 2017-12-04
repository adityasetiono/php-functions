<?php

namespace adityasetiono\tests\entity;

class App
{
    protected $name;

    public function getName(): string
    {
        return $this->name;
    }

    public function setName($name): App
    {
        $this->name = $name;

        return $this;
    }
}