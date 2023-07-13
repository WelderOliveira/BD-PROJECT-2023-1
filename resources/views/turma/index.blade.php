<x-layout title="Turmas">
    <form action="{{ route('index.turmas') }}" method="GET" class="form-inline">
        <div class="row mb-3">
            <div class="col-md-4 mr-2">
                <input type="text" class="form-control" id="filtro_professor" name="filtro_professor"
                       placeholder="Filtrar por Professor">
            </div>
            <div class="col-md-3 mr-2">
                <input type="text" class="form-control" id="filtro_disciplina" name="filtro_disciplina"
                       placeholder="Filtrar por Disciplina">
            </div>
            <div class="col-md-4 mr-2">
                <input type="text" class="form-control" id="filtro_departamento" name="filtro_departamento"
                       placeholder="Filtrar por Departamento">
            </div>
            <div class="col-md-1">
                <button type="submit" class="btn btn-outline-secondary"><i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
    </form>
    <table class="table">
        <thead>
        <tr>
            <th scope="col">Turma</th>
            <th scope="col">Período</th>
            <th scope="col">Professor</th>
            <th scope="col">Horario</th>
            <th scope="col">Vagas</th>
            <th scope="col">Local</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Departamento</th>
            <th scope="col" class="align-content-center align-items-center"><i class="fa-solid fa-gear"></i></th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        @foreach($turmas as $turma)

            <tr>
                <th scope="row">{{$turma->turma}}</th>
                <td>{{$turma->periodo}}</td>
                <td>{{$turma->professor}}</td>
                <td>{{$turma->horario}}</td>
                <td>{{$turma->vagas}}</td>
                <td>{{$turma->local}}</td>
                <td>{{$turma->disciplina}}</td>
                <td>{{$turma->departamento}}</td>
                <td>
                    @if(session()->has('id'))
                        <form action="{{route('delete.turmas',$turma->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{ method_field('DELETE') }}

                            <button type="submit" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                        </form>
                    @endif
                    <form action="{{route('show.turma', $turma->id)}}" method="get">
                        <button type="submit" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                    </form>
                    <form action="{{route('create.avaliacao', $turma->id)}}" method="get">
                        <button type="submit" class="btn btn-info"><i class="fa-regular fa-comments"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
