<?php
Class Player
{
    private string $name;
    private string $city;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    final public function setCity(string $city): Player
    {
        $this->city = $city;
        return $this;
    }

    final public function getName(): string
    {
        return $this->name;
    }

    final public function getCity(): string
    {
        return $this->city;
    }
}
