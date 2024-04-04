<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    </head>
    <body>
        <div class="sign">
            <div id="title"> 
                <img src="../img/user_image.jpg" />Votre profil :
            </div>
            <form action="/auth/register" method="post" >
            @csrf
            <div class="grill">
                <label for="name">Pseudo: </label>
                <input type="text" name="name" value="{{ Auth::user()->name }}" required/>
                <label for="email">Email: </label>
                <input type="email" name="email" value="{{Auth::user()->email}}" required/>
                <label for="first_name">Prenom: </label>
                <input type="first_name" name="first_name" value="{{Auth::user()->first_name}}"/>
                <label for="last_name">Nom: </label>
                <input type="text" name="last_name" value="{{Auth::user()->last_name}}"/>
                <label for="birth">Date de naissance: </label>
                <input type="date" name="birth" value="{{Auth::user()->birth}}"/>
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
                <input type="text" name="job" value="{{Auth::user()->job}}"/>
                <label for="password">Mot de passe: </label>
                <input type="password" name="password" required/>
                <label for="password_confirmation">Confirmation du mot de passe: </label>
                <input type="password" name="password_confirmation" required/>
            </div>
            <div class="button">
                <input type="submit" value="Modifier le profil"/>
            </div>
            </form>
        </div>
    </body>
</html>