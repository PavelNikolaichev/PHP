<?php
Class Player
{
    private $name;
    private $city;

    function __construct($name)
    {
        $this->name = $name;
    }

    function setCity($city)
    {
        $this->city = $city;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCity()
    {
        return $this->city;
    }
}
