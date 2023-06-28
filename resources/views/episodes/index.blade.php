<x-layout title="{{$seriesName . ' - Temporada ' . $season->number}}">
    @isset($messageSuccess)
        <div class="alert alert-success">{{$messageSuccess}}</div>
    @endisset

    @isset($messageError)
    <div class="alert alert-danger">{{$messageError}}</div>
    @endisset

    <form action="{{route('episodes.update', $season->id)}}" method="POST" class="mb-5">
        @csrf
        @method('PATCH')

        <ul class="list-group">
            @foreach($episodes as $episode)
                <li class="list-group-item d-flex justify-content-between align-items-center p-3">
                    Episódio {{$episode->number}}

                    @if ($episode->watched)
                        <input type="checkbox" name="inputEpisode[]" value="{{$episode->id}}" checked>
                    @else
                        <input type="checkbox" name="inputEpisode[]" value="{{$episode->id}}">
                    @endif
                </li>
            @endforeach
        </ul>

        <button type="submit" class="btn btn-primary mt-2">Salvar</button>
        <a href="{{route('series.index')}}" class="btn btn-secondary mt-2">Voltar</a>
    </form >
</x-layout>


