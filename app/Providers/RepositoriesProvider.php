<?php

namespace App\Providers;

use App\Repositories\EloquentEpisodesRepository;
use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentSeriesRepository;
use App\Repositories\EpisodesRepository;
use Illuminate\Contracts\Support\DeferrableProvider;

class RepositoriesProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
        EpisodesRepository::class => EloquentEpisodesRepository::class,
    ];

    public function provides(): array
    {
        return array_keys($this->bindings);
    }
}
