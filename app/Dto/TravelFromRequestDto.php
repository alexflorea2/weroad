<?php

namespace App\Dto;

class TravelFromRequestDto
{
    public ?string $title = null;
    public ?int $numberOfDays = null;
    public ?string $description = null;
    public ?array $moods = [];

    /**
     * @return array|null
     */
    public function getMoods(): ?array
    {
        return $this->moods;
    }

    /**
     * @param array|null $moods
     * @return TravelFromRequestDto
     */
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

    /**
     * @return float|null
     */
    public function getNumberOfDays(): ?float
    {
        return $this->numberOfDays;
    }

    /**
     * @param float|null $numberOfDays
     * @return TravelFromRequestDto
     */
    public function setNumberOfDays(?float $numberOfDays): TravelFromRequestDto
    {
        $this->numberOfDays = $numberOfDays;
        return $this;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string|null $description
     * @return TravelFromRequestDto
     */
    public function setDescription(?string $description): TravelFromRequestDto
    {
        $this->description = $description;
        return $this;
    }

}
