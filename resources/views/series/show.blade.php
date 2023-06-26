<x-layout title="{{$series->name}}">
    <ul class="list-group">
        @foreach($seasons as $season)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                    <a style="color: darkcyan" href="{{route('episodes.index', $season->id)}}">
                        Temporada {{$season->number}}
                    </a>

                    <span class="text-bg-secondary p-2 rounded">
                        {{$season->episodes->count()}}
                    </span>
            </li>
        @endforeach
    </ul>

    <a href="{{route('series.index')}}" class="btn btn-secondary mt-2">Voltar</a>
</x-layout>


