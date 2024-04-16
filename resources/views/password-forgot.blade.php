<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/about.css') }}">
    </head>
    <body>
        <div class="box">
            <div class="sign">
                <h1>Réinitialiser son mot de passe</h1>
                <form method="post" action="/auth/password-request">
                    @csrf
                    <input type="email" name="email" class="@error('email') invalid @enderror">
                    @error("email")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <input type="submit" value="Envoyer">
                </form>
            </div>
        </div>
    </body>
</html>
