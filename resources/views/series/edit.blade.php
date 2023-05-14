<x-layout title="Editar Série - {{$series->name}}">
    <form action="{{route('series.update', $series->id)}}" method="POST" class="px-2 py-2">
        @csrf
        @method('PUT')
        <label clas="form-label" for="name">Nome</label>
        <input class="form-control" type="text" id='name' name="name" value="{{$series->name}}">

        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
        <a href="{{route('series.index')}}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>

</x-layout>
