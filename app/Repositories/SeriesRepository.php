<?php

namespace App\Repositories;

use App\Models\Serie;

interface SeriesRepository
{
    /**
     * @param array ['SeriesName', 'SeasonsAmount', 'EpisodesAmount']
     * @return Serie
     */
    public function store(array $payload): Serie;
}
