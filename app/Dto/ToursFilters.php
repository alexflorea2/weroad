<?php

namespace App\Dto;

class ToursFilters implements CacheableDto
{
    public ?string $slug = null;
    public ?float $priceFrom = null;
    public ?float $priceTo = null;
    public ?string $dateFrom = null;
    public ?string $dateTo = null;
    public ?string $sortPrice = null;

    /**
     * @return string|null
     */
    public function getSlug(): ?string
    {
        return $this->slug;
    }

    /**
     * @param string|null $slug
     * @return ToursFilters
     */
    public function setSlug(?string $slug): ToursFilters
    {
        $this->slug = $slug;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceFrom(): ?float
    {
        return $this->priceFrom;
    }

    /**
     * @param float|null $priceFrom
     * @return ToursFilters
     */
    public function setPriceFrom(?float $priceFrom): ToursFilters
    {
        $this->priceFrom = $priceFrom;
        return $this;
    }

    /**
     * @return float|null
     */
    public function getPriceTo(): ?float
    {
        return $this->priceTo;
    }

    /**
     * @param float|null $priceTo
     * @return ToursFilters
     */
    public function setPriceTo(?float $priceTo): ToursFilters
    {
        $this->priceTo = $priceTo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateFrom(): ?string
    {
        return $this->dateFrom;
    }

    /**
     * @param string|null $dateFrom
     * @return ToursFilters
     */
    public function setDateFrom(?string $dateFrom): ToursFilters
    {
        $this->dateFrom = $dateFrom;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDateTo(): ?string
    {
        return $this->dateTo;
    }

    /**
     * @param string|null $dateTo
     * @return ToursFilters
     */
    public function setDateTo(?string $dateTo): ToursFilters
    {
        $this->dateTo = $dateTo;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getSortPrice(): ?string
    {
        return $this->sortPrice;
    }

    /**
     * @param string|null $sortPrice
     * @return ToursFilters
     */
    public function setSortPrice(?string $sortPrice): ToursFilters
    {
        $this->sortPrice = $sortPrice;
        return $this;
    }

    /**
     * Generate a unique identifier for this DTO.
     *
     * @return string
     */
    public function toCacheKey(): string
    {
        $properties = [
            'slug' => $this->slug,
            'priceFrom' => $this->priceFrom,
            'priceTo' => $this->priceTo,
            'dateFrom' => $this->dateFrom,
            'dateTo' => $this->dateTo,
            'sortPrice' => $this->sortPrice,
        ];

        // Filter out null values to ensure they don't affect the generated key
        $filtered = array_filter($properties, fn($value) => !is_null($value));

        return 'tours_ ' . md5(json_encode($filtered));
    }
}
