<?php

namespace App\Http\Controllers;

use App\Models\Serie;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SerieController extends Controller
{
    public function index()
    {
        $series = Serie::query()->orderBy('name', 'asc')->get();

        return view('series.index')->with('series', $series);
    }

    public function store(Request $request): RedirectResponse
    {
        Serie::create($request->all());

        return to_route('series.index');
    }
}
