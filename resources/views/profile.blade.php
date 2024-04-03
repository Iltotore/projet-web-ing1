<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
    </head>
    <body>    
        <div class="sign">
            <form action="/auth/register" method="post" >
            @csrf
            <div class="grill">
                <label for="name">Pseudo: </label>
                <input type="text" name="name" class="name" required/>
                <label for="email">Email: </label>
                <input type="email" name="email" class="email" required/>
                <label for="first_name">Prenom: </label>
                <input type="first_name" name="first_name" class="first_name"/>
                <label for="last_name">Nom: </label>
                <input type="text" name="last_name" class="last_name" />
                <label for="birth">Date de naissance: </label>
                <input type="date" name="birth" class="birth"/>
                <legend>Genre: </legend>
                <div id=genre>
                    <label for="gender">Homme </label>
                    <input type="radio" name="gender" value="male" class="gender"/>
                    <label for="gender">Femme </label>
                    <input type="radio" name="gender" value="female" class="gender"/>
                    <label for="gender">Autre </label>
                    <input type="radio" name="gender" value="other" class="gender"/>
                </div>
                <label for="profession">Metier: </label>
                <input type="text" name="profession" class="profession"/>
                <label for="password">Mot de passe: </label>
                <input type="password" name="password" class="password" required/>
                <label for="password_confirmation">Confirmation du mot de passe: </label>
                <input type="password" name="password_confirmation" class="password" required/>
            </div>
            <div class="button">
                <input type="submit" value="Mettre a jour le profil"/>
            </div>
            </form>
        </div>
    </body>
</html>