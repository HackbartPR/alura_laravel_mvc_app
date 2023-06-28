<?php

namespace App\Http\Controllers;

use App\Models\Season;
use App\Models\Episode;
use Illuminate\Http\Request;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Repositories\EpisodesRepository;

class EpisodeController extends Controller
{
    public function __construct(
        private EpisodesRepository $repository
    ){}

    public function index(Season $season): View
    {
        $messageSuccess = session('message.success');
        $messageError = session('message.error');

        return view('episodes.index')
            ->with('season', $season)
            ->with('episodes', $season->episodes)
            ->with('messageError', $messageError)
            ->with('messageSuccess', $messageSuccess)
            ->with('seriesName', $season->series->name);
    }

    public function update(Request $request, Season $season): RedirectResponse
    {
        $episodesWatched = $request->inputEpisode;

        $listChecked = [];
        $season->episodes->each(function (Episode $episode) use ($episodesWatched, &$listChecked) {
            in_array($episode->id, $episodesWatched) ? ($listChecked[] = $episode->id) : null;
        });

        if (!$this->repository->update($season, $listChecked)) {
            return to_route('episodes.index', $season->id)
                ->with('message.error', 'Ops, tente novamente!');
        }

        return to_route('episodes.index', $season->id)
                ->with('message.success', "Episódios atualizados com sucesso!");
    }

}
