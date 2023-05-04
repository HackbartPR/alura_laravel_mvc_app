<x-layout title="Nova Série">
    <form action="{{route('series.store')}}" method="POST" class="px-2 py-2">
        @csrf
        <label clas="form-label" for="name">Nome</label>
        <input class="form-control" type="text" id='name' name="name">
        <button type="submit" class="btn btn-primary mt-2">Adicionar</button>
    </form>
</x-layout>
