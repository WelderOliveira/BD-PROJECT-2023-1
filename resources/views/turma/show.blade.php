<x-layout title="Turma">
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h2 class="text-center">Detalhes da Turma</h2>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-6">
                        <strong>Turma: </strong>{{$response->turma}}<br>
                        <strong>Período: </strong>{{$response->periodo}}<br>
                        <strong>Professor: </strong>{{$response->professor}}<br>
                        <strong>Horário: </strong>{{$response->horario}}<br>
                    </div>
                    <div class="col-md-6">
                        <strong>Vagas: </strong>{{$response->vagas}}<br>
                        <strong>Local: </strong>{{$response->local}}<br>
                        <strong>Disciplina: </strong>{{$response->disciplina}}<br>
                        <strong>Departamento: </strong>{{$response->departamento}}<br>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        @if($comments)
            @foreach($comments as $comment)
                <div class="card mb-3">
                    <div class="card-header">
                        Nota: {{$comment->nota}}
                    </div>
                    <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>{{$comment->descricao}}</p>
                            <footer class="blockquote-footer">{{$comment->nome}} - <cite title="{{$comment->curso}}">{{$comment->curso}}</cite></footer>
                        </blockquote>
                    </div>
                </div>
            @endforeach
        @else
            <h4 align="center">Não possuí avaliações</h4>
        @endif
    </div>
</x-layout>
