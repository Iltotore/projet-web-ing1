<html>
<body>
<h1>Réinitialiser son mot de passe</h1>
<form method="post" action="/auth/password-request">
    @csrf
    <input type="email" name="email" class="@error('email') invalid @enderror">
    @error("email")
        <li class="error">{{ $message }}</li>
    @enderror
    <input type="submit" value="Envoyer">
</form>
</body>
</html>
