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
            Serie::create($request->all());
            $request->session()->flash('message.success', 'Série criada com sucesso!');
        }catch(Exception $e) {
            $request->session()->flash('message.error', 'Ops, tente novamente!');
        }

        return to_route('series.index');
    }

    public function destroy(Request $request): RedirectResponse
    {
        try{
            Serie::destroy($request->series);
            $request->session()->flash('message.success', 'Série deletada com sucesso!');
        }catch(Exception $e) {
            $request->session()->flash('message.error', 'Ops, tente novamente!');
        }

        return to_route('series.index');
    }
}
