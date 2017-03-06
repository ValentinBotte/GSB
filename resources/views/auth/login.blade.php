@extends('layouts.app')

@section('content')


    <h1><img src="./images/logo.jpg" class="img-responsive center-block" alt="Laboratoire Galaxy-Swiss Bourdin" title="Laboratoire Galaxy-Swiss Bourdin"></h1>


    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Identification utilisateur</h3>
                </div>
                <div class="panel-body">

                    @if (count($errors) > 0)
                        <div class="alert alert-danger">
                            <ul>
                                <li>Identifiants incorrects.</li>
                            </ul>
                        </div>
                    @endif

                    <form role="form" method="post" action="">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                                    <input class="form-control" placeholder="Login" name="email" type="text" maxlength="45">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="input-group">
                                    <span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
                                    <input class="form-control" placeholder="Mot de passe" name="password" type="password" maxlength="45">
                                </div>
                            </div>
                            <input class="btn btn-lg btn-success btn-block" type="submit" value="Se connecter">
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

