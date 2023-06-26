<?php

namespace App\Providers;

use App\Repositories\SeriesRepository;
use Illuminate\Support\ServiceProvider;
use App\Repositories\EloquentSeriesRepository;
use Illuminate\Contracts\Support\DeferrableProvider;

class RepositoriesProvider extends ServiceProvider implements DeferrableProvider
{
    public $bindings = [
        SeriesRepository::class => EloquentSeriesRepository::class,
    ];

    public function provides(): array
    {
        return array_keys($this->bindings);
    }
}
