<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Serie;
use App\Models\Season;
use App\Models\Episode;
use Illuminate\Support\Facades\DB;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use App\Repositories\SeriesRepository;
use App\Http\Requests\SeriesFormRequest;
use App\Http\Requests\SeriesUpdateFormRequest;

class SerieController extends Controller
{
    public function __construct(
        private SeriesRepository $repository,
    ){}

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
        $payload = $request->only(['name', 'seasons', 'episodes']);

        try{
            $series = $this->repository->store($payload);

            return to_route('series.index')
                ->with('message.success', "Série '{$series->name}' criada com sucesso!");
        }catch(Exception $e) {

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


}
