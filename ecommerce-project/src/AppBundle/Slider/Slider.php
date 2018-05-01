<?php

namespace AppBundle\Slider;


use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

class Slider
{
    public function getSlides()
    {
        try {

            return Yaml::parseFile(__DIR__ . '/slider.yml')['slides'];

        } catch (ParseException $exception) {

            printf('Unable to parse the YAML string: %s', $exception->getMessage());

        }
    }

}