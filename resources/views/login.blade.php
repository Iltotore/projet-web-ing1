<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>
        <div class="box">
            <div class="sign">
                <form action="/auth/login" method="post">
                @csrf
                <input type="hidden" name="redirect" value="{{ request()->get('redirect') ?? '/' }}">
                <div class="grill">
                    <label for="name" >Pseudo: </label>
                    <input type="text" name="name" required/>
                    <label for="password" >Mot de passe: </label>
                    <input type="password" name="password" required/>
                    <a href="/forgot-password">Mot de passe oublié ?</a>
                </div>
                <div class="button">
                    <input type="submit" value="Connexion"/>
                </div>
                </form>
            </div>
            <div class="sign">
                <form action="/auth/register" method="post" >
                @csrf
                <div class="grill">
                    <label for="name">Pseudo: </label>
                    <input type="text" name="name" required/>
                    <label for="email">Email: </label>
                    <input type="email" name="email" required/>
                    <label for="first_name">Prenom: </label>
                    <input type="text" name="first_name"/>
                    <label for="last_name">Nom: </label>
                    <input type="text" name="last_name"/>
                    <label for="birth">Date de naissance: </label>
                    <input type="date" name="birth"/>
                    <legend>Genre: </legend>
                    <div id=genre>
                        <label for="gender">Homme </label>
                        <input type="radio" name="gender" value="male"/>
                        <label for="gender">Femme </label>
                        <input type="radio" name="gender" value="female"/>
                        <label for="gender">Autre </label>
                        <input type="radio" name="gender" value="other"/>
                    </div>
                    <label for="job">Metier: </label>
                    <select name="job" id="job">
                        <option value="null"></option>
                        @foreach(\App\Models\Job::all() as $job)
                            <option value="{{$job->id}}">{{$job->name}}</option>
                        @endforeach
                    </select>
                    <label for="password">Mot de passe: </label>
                    <input type="password" name="password" required/>
                    <label for="password_confirmation">Confirmation du mot de passe: </label>
                    <input type="password" name="password_confirmation" required/>
                </div>
                <div class="button">
                    <input type="submit" value="Inscription"/>
                </div>
                </form>
            </div>
        </div>
    </body>
</html>
