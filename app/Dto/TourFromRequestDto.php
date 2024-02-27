<?php

namespace App\Dto;

use Carbon\Carbon;

class TourFromRequestDto
{
    public ?string $travelId = null;

    public ?string $title = null;

    public ?Carbon $startingDate = null;

    public ?Carbon $endingDate = null;

    public ?float $price = null;

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): TourFromRequestDto
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getStartingDate(): ?Carbon
    {
        return $this->startingDate;
    }

    /**
     * @param  \DateTime|null  $startingDate
     */
    public function setStartingDate(?Carbon $startingDate): TourFromRequestDto
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    /**
     * @return \DateTime|null
     */
    public function getEndingDate(): ?Carbon
    {
        return $this->endingDate;
    }

    /**
     * @param  \DateTime|null  $endingDate
     */
    public function setEndingDate(?Carbon $endingDate): TourFromRequestDto
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getTravelId(): ?string
    {
        return $this->travelId;
    }

    public function setTravelId(?string $travelId): TourFromRequestDto
    {
        $this->travelId = $travelId;

        return $this;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }

    public function setPrice(?float $price): TourFromRequestDto
    {
        $this->price = $price;

        return $this;
    }
}
