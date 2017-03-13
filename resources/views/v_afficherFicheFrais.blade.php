@extends('layouts.app')

@section('content')
    <h2>Mes fiches de frais</h2>
    <div class="row">
        <div class="col-md-4">
            <h3>Sélectionner un mois : </h3>
        </div>
        <div class="col-md-4">
            <form action="" method="post" role="form">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="lstMois" accesskey="n">Mois : </label>
                    <select id="lstMois" name="mois" class="form-control">

                        @foreach ($mois as $unMois)
                            <option value="{{ $unMois->mois }}">{{ $unMois->mois }}</option>
                        @endforeach

                    </select>
                </div>
                <input id="ok" type="submit" value="Valider" class="btn btn-success" role="button" />
                <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" role="button" />
            </form>
        </div>
    </div>
@endsection


@section('content_secondary')

@endsection