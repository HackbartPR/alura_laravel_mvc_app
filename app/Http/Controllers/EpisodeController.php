<?php

namespace App\Http\Controllers;

use App\Models\Season;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class EpisodeController extends Controller
{
    public function index(Season $season): View
    {
        return view('episodes.index')
            ->with('seriesName', $season->series->name)
            ->with('seasonNumber', $season->number)
            ->with('episodes', $season->episodes);
    }
}
