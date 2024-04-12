<html>
<body>
<form method="post" action="/auth/reset-password">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <input type="email" name="email" class="@error('email') invalid @enderror">
    @error("email")
        <li class="error">{{ $message }}</li>
    @enderror
    <input type="password" name="password" class="@error('password') invalid @enderror">
    @error("password")
        <li class="error">{{ $message }}</li>
    @enderror
    <input type="password" name="password_confirmation" class="@error('password') invalid @enderror">
    @error("password")
        <li class="error">{{ $message }}</li>
    @enderror
    <input type="submit" value="Réinitialiser mon mot de passe">
</form>
</body>
</html>
