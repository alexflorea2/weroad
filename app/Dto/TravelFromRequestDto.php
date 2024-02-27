<?php

namespace App\Dto;

class TravelFromRequestDto
{
    public ?string $title = null;

    public ?int $numberOfDays = null;

    public ?string $description = null;

    public ?array $moods = [];

    public ?bool $isPublic = false;

    public function getMoods(): ?array
    {
        return $this->moods;
    }

    public function setMoods(?array $moods): TravelFromRequestDto
    {
        $this->moods = $moods;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): TravelFromRequestDto
    {
        $this->title = $title;

        return $this;
    }

    public function getNumberOfDays(): ?float
    {
        return $this->numberOfDays;
    }

    public function setNumberOfDays(?float $numberOfDays): TravelFromRequestDto
    {
        $this->numberOfDays = $numberOfDays;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): TravelFromRequestDto
    {
        $this->description = $description;

        return $this;
    }

    public function getIsPublic(): ?bool
    {
        return $this->isPublic;
    }

    /**
     * @return TourFromRequestDto
     */
    public function setIsPublic(?bool $isPublic): TravelFromRequestDto
    {
        $this->isPublic = $isPublic;

        return $this;
    }
}
