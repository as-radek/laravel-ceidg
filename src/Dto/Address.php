<?php

declare(strict_types=1);


namespace Opal\OpalCeidg\Dto;


class Address
{
    /**
     * @var string|null
     */
    protected $street;

    /**
     * @var string
     */
    protected $building;

    /**
     * @var string
     */
    protected $city;

    /**
     * @var string
     */
    protected $voivodeship;

    /**
     * @var string
     */
    protected $county;

    /**
     * @var string
     */
    protected $commune;

    /**
     * @var string
     */
    protected $country;

    /**
     * @param string $building
     * @param string $city
     * @param string $voivodeship
     * @param string $county
     * @param string $commune
     * @param string $country
     * @param string|null $street
     */
    public function __construct(string $building, string $city, string $voivodeship, string $county, string $commune, string $country, ?string $street = null)
    {
        $this->building = $building;
        $this->city = $city;
        $this->voivodeship = $voivodeship;
        $this->county = $county;
        $this->commune = $commune;
        $this->country = $country;
        $this->street = $street;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string
     */
    public function getBuilding(): string
    {
        return $this->building;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @return string
     */
    public function getVoivodeship(): string
    {
        return $this->voivodeship;
    }

    /**
     * @return string
     */
    public function getCounty(): string
    {
        return $this->county;
    }

    /**
     * @return string
     */
    public function getCommune(): string
    {
        return $this->commune;
    }

    /**
     * @return string
     */
    public function getCountry(): string
    {
        return $this->country;
    }
}