<?php

declare(strict_types=1);


namespace Opal\OpalCeidg\Dto;


class Company
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var Owner
     */
    protected $owner;

    /**
     * @var Address
     */
    protected $address;

    /**
     * @param int $id
     * @param string $name
     * @param Owner $owner
     * @param Address $address
     */
    public function __construct(int $id, string $name, Owner $owner, Address $address)
    {
        $this->id = $id;
        $this->name = $name;
        $this->owner = $owner;
        $this->address = $address;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return Owner
     */
    public function getOwner(): Owner
    {
        return $this->owner;
    }

    /**
     * @return Address
     */
    public function getAddress(): Address
    {
        return $this->address;
    }
}