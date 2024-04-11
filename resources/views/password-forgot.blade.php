<html>
<body>
<h1>Réinitialiser son mot de passe</h1>
<form method="post" action="/auth/password-request">
    @csrf
    <input type="email" name="email">
    <input type="submit" value="Envoyer">
</form>
</body>
</html>
