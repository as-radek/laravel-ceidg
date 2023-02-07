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
     * @var string|null
     */
    protected $voivodeship;

    /**
     * @var string|null
     */
    protected $county;

    /**
     * @var string|null
     */
    protected $commune;

    /**
     * @var string|null
     */
    protected $country;

    /**
     * @var string|null
     */
    protected $zip;

    /**
     * @param string $city
     * @param string|null $voivodeship
     * @param string|null $county
     * @param string|null $commune
     * @param string|null $country
     * @param string|null $street
     * @param string|null $zip
     * @param string|null $building
     */
    public function __construct(string $city, ?string $voivodeship, ?string $county, ?string $commune, ?string $country, ?string $street = null, ?string $zip = null, ?string $building = '')
    {
        $this->building = $building;
        $this->city = $city;
        $this->voivodeship = $voivodeship;
        $this->county = $county;
        $this->commune = $commune;
        $this->country = $country;
        $this->street = $street;
        $this->zip = $zip;
    }

    /**
     * @return string|null
     */
    public function getStreet(): ?string
    {
        return $this->street;
    }

    /**
     * @return string|null
     */
    public function getBuilding(): ?string
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
     * @return string|null
     */
    public function getVoivodeship(): ?string
    {
        return $this->voivodeship;
    }

    /**
     * @return string|null
     */
    public function getCounty(): ?string
    {
        return $this->county;
    }

    /**
     * @return string|null
     */
    public function getCommune(): ?string
    {
        return $this->commune;
    }

    /**
     * @return string|null
     */
    public function getCountry(): ?string
    {
        return $this->country;
    }

    /**
     * @return string|null
     */
    public function getZip(): ?string
    {
        return $this->zip;
    }
}