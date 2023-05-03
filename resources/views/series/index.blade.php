<x-layout title='Séries'>
    <a class="mb-2 btn btn-dark" href="/series/create">Adicionar</a>
    <ul class="list-group">
        @foreach($series as $serie)
            <li class="list-group-item">{{$serie->name}}</li>
        @endforeach
    </ul>
</x-layout>


