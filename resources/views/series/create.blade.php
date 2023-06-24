<x-layout title="Nova Série">
    @include('components.flash_errors')

    <form action="{{route('series.store')}}" method="POST" class="px-2 py-2">
        @csrf

        <div class="row">
            <div class="col-8">
                <label clas="form-label" for="name">Nome</label>
                <input class="form-control" type="text" id='name' name="name">
            </div>
            <div class="col-2">
                <label clas="form-label" for="name">Quantidade Temporadas</label>
                <input class="form-control" type="number" id='seasons' name="seasons">
            </div>
            <div class="col-2">
                <label clas="form-label" for="name">Episódios por Temporadas</label>
                <input class="form-control" type="number" id='episodes' name="episodes">
            </div>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Adicionar</button>
    </form>
</x-layout>

