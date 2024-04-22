<!DOCTYPE html>
<html>
<body>
<div class="box">
    <div class="sign">
        <form method="post" action="/auth/reset-password">
            @csrf
            <input type="hidden" name="token" value="{{ $token }}">
            <div class="grill">
                <label for="email">Email: </label>
                <input type="email" name="email" class="@error('email') invalid @enderror">
                @error("email")
                <li class="error">{{ $message }}</li>
                @enderror
                <label for="password">Mot de passe: </label>
                <input type="password" name="password" class="@error('password') invalid @enderror">
                @error("password")
                <li class="error">{{ $message }}</li>
                @enderror
                <label for="password_confirmation">Confirmer le mot de passe: </label>
                <input type="password" name="password_confirmation" class="@error('password') invalid @enderror">
                @error("password")
                <li class="error">{{ $message }}</li>
                @enderror
            </div>
            <input class="button" type="submit" value="Réinitialiser mon mot de passe">
        </form>
    </div>
</div>
</body>
</html>
