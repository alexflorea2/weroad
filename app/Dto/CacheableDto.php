<?php

namespace App\Dto;

interface CacheableDto
{
    public function toCacheKey(): string;
}
