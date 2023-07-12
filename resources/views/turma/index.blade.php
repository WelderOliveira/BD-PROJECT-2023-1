<x-layout title="Criar">
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
                        <button type="button" class="btn btn-danger"><i class="fa-solid fa-trash"></i></button>
                    @endif
                    <button type="button" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
