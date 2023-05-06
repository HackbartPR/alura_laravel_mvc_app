<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Exception;
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

    public function store(Request $request): RedirectResponse
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
                ->with('message.success', "Série '{$series->name}' deletada com sucesso!");
        }catch(Exception $e) {

            return to_route('series.index')
                ->with('message.error', 'Ops, tente novamente!');
        }
    }
}
