<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateFormRequest;
use App\Models\Episode;
use App\Models\Season;
use App\Models\Serie;
use Exception;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::all();

        $messageSuccess = session('message.success');
        $messageError = session('message.error');

        return view('series.index')
            ->with('series', $series)
            ->with('messageSuccess', $messageSuccess)
            ->with('messageError', $messageError);
    }

    public function show(Serie $series): View
    {
        $seasons = $series->seasons()->with('episodes')->get();

        return view('series.show')
            ->with('series', $series)
            ->with('seasons', $seasons);
    }

    public function create(): View
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request): RedirectResponse
    {
        try{
            $series = Serie::create($request->all());

            $seasonList = $this->createSeasonList($request->seasons, $series->id);
            Season::insert($seasonList);

            $episodesList = [];
            foreach ($series->seasons as $season) {
                $episodesList = array_merge($episodesList, $this->createEpisodeList($request->episodes, $season->id));
            }
            Episode::insert($episodesList);

            return to_route('series.index')
                ->with('message.success', "Série '{$series->name}' criada com sucesso!");
        }catch(Exception $e) {
            dd($e);
            return to_route('series.index')
            ->with('message.error', 'Ops, tente novamente!');
        }
    }

    public function destroy(Serie $series): RedirectResponse
    {
        try{
            $series->deleteOrFail();

            return to_route('series.index')
                ->with('message.success', "Série '{$series->name}' foi deletada com sucesso!");
        }catch(Exception $e) {

            return to_route('series.index')
                ->with('message.error', 'Ops, tente novamente!');
        }
    }

    public function edit(Serie $series): View
    {
        $seasons = $series->seasons()->with('episodes')->get();
        $seasonAmount = $seasons->count();
        $episodesAmount = $seasons[0]->episodes->count();

        return view('series.edit')
            ->with('series', $series)
            ->with('seasons', $seasonAmount)
            ->with('episodes', $episodesAmount);
    }

    public function update(SeriesUpdateFormRequest $request, Serie $series):RedirectResponse
    {
        try{
            $series->fill($request->all());
            $series->save();

            return to_route('series.index')
                ->with('message.success', "Série '{$series->name}' foi atualizada com sucesso!");
        }catch(Exception $e){
            return to_route('series.index')
            ->with('message.error', 'Ops, tente novamente!');
        }
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
