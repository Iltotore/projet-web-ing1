<html>
<body>
<form method="post" action="/auth/reset-password">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email">
    <input type="password" name="password">
    <input type="password" name="password_confirmation">
    <input type="submit" value="Réinitialiser mon mot de passe">
</form>
</body>
</html>
