<x-layout title="{{$seriesName . ' - Temporada ' . $seasonNumber}}">
    <ul class="list-group">
        @foreach($episodes as $episode)
            <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                Episódio {{$episode->number}}

                <input type="checkbox" name="inputEpisode[]" value="{{$episode->id}}">
            </li>
        @endforeach
    </ul>

    <a href="{{route('series.index')}}" class="btn btn-secondary mt-2">Voltar</a>
</x-layout>


