@extends('layouts.appComptable')

@section('content')
        <h2>Suivi de remboursement des Frais</h2>
        <div class="row">
            <div class="col-md-4">
                <h3>Sélectionner un mois et un visiteur : </h3>
            </div>
            <div class="col-md-4">
                <form action="" method="post" role="form">
                    {{ csrf_field() }}
                    <div class="form-group"><br>
                        <select id="lstVisiteur" name="visiteur" class="form-control">

                            <option value="" disabled selected>Choisir un visiteur</option>
                            @foreach ($lesVisiteurs as $unVisiteur)
                                @if(!empty($visiteur2) and $visiteur2[0]->id == $unVisiteur->id)
                                    <option value="{{ $visiteur2[0]->id }}" selected="selected">{{ $visiteur2[0]->name }}</option>
                                @else
                                    <option value="{{ $unVisiteur->id }}">{{ $unVisiteur->name }}</option>
                                @endif
                            @endforeach

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="lstMois" accesskey="n">Mois : </label>
                        <select id="lstMois" name="mois" class="form-control">
                            @if(!empty($afficheMois))
                                @foreach ($afficheMois as $unMois)
                                    @if(!empty($mois) and $mois == $unMois)
                                        <option value="{{ $mois }}" selected="selected">{{ $mois }}</option>
                                    @else
                                        <option value="{{ $unMois }}">{{ $unMois }}</option>
                                    @endif
                                @endforeach
                            @endif

                        </select>
                    </div>
                    <input id="ok" type="submit" name="submit" value="Valider" class="btn btn-success" role="button" />
                    <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" role="button" />
                </form>
            </div>
        </div>
@endsection


@section('content_secondary')


    <script>

        $("#lstVisiteur").change(function() {

            var idVisiteur = $("#lstVisiteur option:selected").val();

            $.get('{{ url('afficher_suivi_frais') }}/getMois?idVisiteur=' + idVisiteur, function(data) {

                $('#lstMois').empty();

                for(var i = 0; i < data.length; i++){
                    $('#lstMois').append(
                        $('<option></option>').val(data[i]).html(data[i])
                    );
                }

            });

        });
    </script>
@endsection
