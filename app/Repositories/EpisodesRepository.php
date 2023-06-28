<?php

namespace App\Repositories;

use App\Models\Season;

interface EpisodesRepository
{
    public function update(Season $season, array $episodesWatched): bool;
}
