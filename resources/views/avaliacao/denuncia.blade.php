<x-layout title="Turmas">
    <table class="table">
        <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Professor</th>
            <th scope="col">Disciplina</th>
            <th scope="col">Departamento</th>
            <th scope="col">Nota</th>
            <th scope="col" class="align-content-center align-items-center"><i class="fa-solid fa-gear"></i></th>
        </tr>
        </thead>
        <tbody class="table-group-divider">
        @foreach($responses as $response)

            <tr>
                <th scope="row">{{$response->id}}</th>
                <td>{{$response->professor}}</td>
                <td>{{$response->disciplina}}</td>
                <td>{{$response->departamento}}</td>
                <td>{{$response->nota}}</td>
                <td>
                    <form action="{{route('show.turma', $response->id_turma)}}" method="get">
                        <button type="submit" class="btn btn-info"><i class="fa-solid fa-eye"></i></button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</x-layout>
