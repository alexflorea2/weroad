<?php

namespace App\Dto;

use Carbon\Carbon;

class TourFromRequestDto
{
    public string $travelId;

    public string $title = '';

    public Carbon $startingDate;

    public Carbon $endingDate;

    public int $price;

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): TourFromRequestDto
    {
        $this->title = $title;

        return $this;
    }

    public function getStartingDate(): Carbon
    {
        return $this->startingDate;
    }

    public function setStartingDate(Carbon $startingDate): TourFromRequestDto
    {
        $this->startingDate = $startingDate;

        return $this;
    }

    public function getEndingDate(): Carbon
    {
        return $this->endingDate;
    }

    public function setEndingDate(Carbon $endingDate): TourFromRequestDto
    {
        $this->endingDate = $endingDate;

        return $this;
    }

    public function getTravelId(): string
    {
        return $this->travelId;
    }

    public function setTravelId(string $travelId): TourFromRequestDto
    {
        $this->travelId = $travelId;

        return $this;
    }

    public function getPrice(): float
    {
        return $this->price;
    }

    public function setPrice(float $price): TourFromRequestDto
    {
        $this->price = $price;

        return $this;
    }
}
