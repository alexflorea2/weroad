<?php

namespace App\Dto;

class TravelFromRequestDto
{
    public string $title = '';

    public int $numberOfDays;

    public string $description = '';

    /**
     * @var mixed[]
     */
    public array $moods = [];

    public bool $isPublic = false;

    /**
     * @return mixed[]|null
     */
    public function getMoods(): array
    {
        return $this->moods;
    }

    /**
     * @param  mixed[]  $moods
     * @return $this
     */
    public function setMoods(array $moods): TravelFromRequestDto
    {
        $this->moods = $moods;

        return $this;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function setTitle(string $title): TravelFromRequestDto
    {
        $this->title = $title;

        return $this;
    }

    public function getNumberOfDays(): int
    {
        return $this->numberOfDays;
    }

    public function setNumberOfDays(int $numberOfDays): TravelFromRequestDto
    {
        $this->numberOfDays = $numberOfDays;

        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): TravelFromRequestDto
    {
        $this->description = $description;

        return $this;
    }

    public function getIsPublic(): bool
    {
        return $this->isPublic;
    }

    public function setIsPublic(bool $isPublic): TravelFromRequestDto
    {
        $this->isPublic = $isPublic;

        return $this;
    }
}
