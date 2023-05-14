<x-layout title='Séries'>
    <a class="mb-2 btn btn-dark" href="{{route('series.create')}}">Adicionar</a>

    @isset($messageSuccess)
        <div class="alert alert-success">{{$messageSuccess}}</div>
    @endisset

    @isset($messageError)
    <div class="alert alert-danger">{{$messageError}}</div>
    @endisset

    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item d-flex justify-content-between align-items-center">
                {{$serie->name}}

                <div class="d-flex justify-content-end align-items-center gap-2">
                    <a href="{{route('series.edit', $serie->id)}}" class="btn btn-outline-info">E</a>

                    <form action="{{route('series.destroy', $serie->id)}}" method="POST">
                        @csrf
                        @method('DELETE')

                        <button class="btn btn-outline-danger">X</button>
                    </form>
                </div>
            </li>
        @endforeach
    </ul>
</x-layout>


