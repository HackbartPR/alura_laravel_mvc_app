<?php

namespace App\Repositories;

use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Exception;
use Illuminate\Support\Facades\DB;

class SeriesRepository
{
    public function store(array $payload): Serie
    {
        $series = DB::transaction(function () use ($payload) {
            try{
                $series = Serie::create($payload);

                $seasonList = $this->createSeasonList($payload['seasons'], $series->id);
                Season::insert($seasonList);

                $episodesList = [];
                foreach ($series->seasons as $season) {
                    $episodesList = array_merge($episodesList, $this->createEpisodeList($payload['episodes'], $season->id));
                }
                Episode::insert($episodesList);

                return to_route('series.index')
                    ->with('message.success', "Série '{$series->name}' criada com sucesso!");
            }catch(Exception $e) {
                throw new Exception($e);
            }
        });

        return $series;
    }

    private function createSeasonList(int $amount, int $serieId): array
    {
        $seasons = [];
        for($i = 1; $i<= $amount; $i++) {
            $seasons[] = [
                'number' => $i,
                'series_id' => $serieId
            ];
        }

        return $seasons;
    }

    private function createEpisodeList(int $amount, int $seasonId): array
    {
        $episodes = [];
        for($i = 1; $i<= $amount; $i++) {
            $episodes[] = [
                'number' => $i,
                'season_id' => $seasonId
            ];
        }

        return $episodes;
    }
}
