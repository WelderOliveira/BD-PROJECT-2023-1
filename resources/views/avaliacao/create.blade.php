@section('style')
    <style>
        .form-group label {
            font-weight: bold;
        }

        .rating {
            display: inline-block;
        }

        .rating input {
            display: none;
        }

        .rating label {
            float: right;
            color: #777777;
            cursor: pointer;
        }

        .rating label:before {
            content: '\2605';
            font-size: 24px;
        }

        .rating input:checked ~ label:before {
            color: #ffca08;
        }
    </style>
@endsection
<x-layout title="Avaliação">
    <div class="container mt-5">
        <h2 align="center">Avaliação de Qualidade</h2>
        <h3 align="center">{{$response->disciplina}}</h3>
        <form action="{{route('store.avaliacao')}}" method="POST">
            @csrf
            <div class="form-group">
                <input type="hidden" name="turma" id="turma" value="{{$response->id}}">
                <label for="nota">Avalie:</label>
                <div class="rating">
                    <input type="radio" id="star5" name="nota" value="5" required/>
                    <label for="star5"></label>
                    <input type="radio" id="star4" name="nota" value="4"/>
                    <label for="star4"></label>
                    <input type="radio" id="star3" name="nota" value="3"/>
                    <label for="star3"></label>
                    <input type="radio" id="star2" name="nota" value="2"/>
                    <label for="star2"></label>
                    <input type="radio" id="star1" name="nota" value="1"/>
                    <label for="star1"></label>
                </div>
            </div>
            <div class="form-group">
                <label for="descricao">Motivo:</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Enviar Avaliação</button>
        </form>
    </div>
</x-layout>
