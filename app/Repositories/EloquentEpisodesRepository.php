<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Repositories\EpisodesRepository;

class EloquentEpisodesRepository implements EpisodesRepository
{
    /**
     * @param Season $season
     * @param array $episodeCheked
     *
     * @return bool
     */
    public function update(Season $season, array $episodeCheked): bool
    {
        return DB::transaction(function () use ($season, $episodeCheked) {
            try{
                $season->episodes()->whereIn('id', $episodeCheked)
                    ->update(['watched' => true]);

                $season->episodes()->whereNotIn('id', $episodeCheked)
                    ->update(['watched' => false]);

                return true;
            }catch(Exception $e) {
                return false;
            }
        });
    }
}
