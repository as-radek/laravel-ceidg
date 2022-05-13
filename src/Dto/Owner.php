<?php

declare(strict_types=1);


namespace Opal\OpalCeidg\Dto;


class Owner
{
    /**
     * @var string
     */
    protected $firstName;

    /**
     * @var string
     */
    protected $lastName;

    /**
     * @var string
     */
    protected $nip;

    /**
     * @var string
     */
    protected $regon;

    /**
     * @param string $firstName
     * @param string $lastName
     * @param string $nip
     * @param string $regon
     */
    public function __construct(string $firstName, string $lastName, string $nip, string $regon)
    {
        $this->firstName = $firstName;
        $this->lastName = $lastName;
        $this->nip = $nip;
        $this->regon = $regon;
    }

    /**
     * @return string
     */
    public function getFirstName(): string
    {
        return $this->firstName;
    }

    /**
     * @return string
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }

    /**
     * @return string
     */
    public function getNip(): string
    {
        return $this->nip;
    }

    /**
     * @return string
     */
    public function getRegon(): string
    {
        return $this->regon;
    }

}