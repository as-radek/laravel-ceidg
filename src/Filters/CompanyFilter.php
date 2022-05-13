<?php

declare(strict_types=1);


namespace Opal\OpalCeidg\Filters;


class CompanyFilter
{
    /**
     * @var string|null
     */
    protected $nip;

    /**
     * @var string|null
     */
    protected $regon;

    /**
     * @var array
     */
    protected $ids;

    /**
     * @param string|null $nip
     * @param string|null $regon
     * @param array $ids
     */
    public function __construct(?string $nip, ?string $regon, array $ids = [])
    {
        $this->nip = $nip;
        $this->regon = $regon;
        $this->ids = $ids;
    }

    /**
     * @return string|null
     */
    public function getNip(): ?string
    {
        return $this->nip;
    }

    /**
     * @return string|null
     */
    public function getRegon(): ?string
    {
        return $this->regon;
    }

    /**
     * @return array
     */
    public function getIds(): array
    {
        return $this->ids;
    }

    /**
     * @param string|null $nip
     */
    public function setNip(?string $nip): void
    {
        $this->nip = $nip;
    }

    /**
     * @param string|null $regon
     */
    public function setRegon(?string $regon): void
    {
        $this->regon = $regon;
    }

    /**
     * @param array $ids
     */
    public function setIds(array $ids): void
    {
        $this->ids = $ids;
    }
}