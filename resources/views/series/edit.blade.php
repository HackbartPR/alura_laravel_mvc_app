<x-layout title="Editar Série - {{$series->name}}">
    @include('components.flash_errors')

    <form action="{{route('series.update', $series->id)}}" method="POST" class="px-2 py-2">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-8">
                <label clas="form-label" for="name">Nome</label>
                <input class="form-control" type="text" id='name' name="name" value="{{old('name') ?? $series->name}}">
            </div>
            <div class="col-2">
                <label clas="form-label" for="name">Quantidade Temporadas</label>
                <input class="form-control" type="number" id='seasons' name="seasons" value={{$seasons}} disabled>
            </div>
            <div class="col-2">
                <label clas="form-label" for="name">Episódios por Temporadas</label>
                <input class="form-control" type="number" id='episodes' name="episodes" value={{$episodes}} disabled>
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Atualizar</button>
        <a href="{{route('series.index')}}" class="btn btn-secondary mt-2">Cancelar</a>
    </form>
</x-layout>
