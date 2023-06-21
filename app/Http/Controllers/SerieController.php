<?php

namespace App\Http\Controllers;

use App\Http\Requests\SeriesFormRequest;
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
        $series = Serie::query()->orderBy('name', 'asc')->get();

        $messageSuccess = session('message.success');
        $messageError = session('message.error');

        return view('series.index')
            ->with('series', $series)
            ->with('messageSuccess', $messageSuccess)
            ->with('messageError', $messageError);
    }

    public function create(): View
    {
        return view('series.create');
    }

    public function store(SeriesFormRequest $request): RedirectResponse
    {
        try{
            $series = Serie::create($request->all());

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
        return view('series.edit')
            ->with('series', $series);
    }

    public function update(SeriesFormRequest $request, Serie $series):RedirectResponse
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
