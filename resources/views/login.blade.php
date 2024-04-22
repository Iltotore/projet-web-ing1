@php use App\Models\Job; @endphp
<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" href="{{ asset('css/login.css') }}">
    </head>
    <body>
    <div class="box">
        <div class="sign">
			<h1>Connexion</h1>
            <form action="/auth/login" method="post">
                @csrf
                <input type="hidden" name="redirect" value="{{ request()->get('redirect') ?? '/' }}">
                <div class="grill">
                    <label for="name">Pseudo: </label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="@error('name') invalid @enderror"/>
                    @error("name")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="password">Mot de passe: </label>
                    <input type="password" name="password" required class="@error('password') invalid @enderror"/>
                    @error("password")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <a href="/forgot-password">Mot de passe oublié ?</a>
                </div>
                <div class="button">
                    <input type="submit" value="Connexion"/>
                </div>
            </form>
        </div>
        <div class="sign">
			<h1>Inscription</h1>
            <form action="/auth/register" method="post">
                @csrf
                <div class="grill">
                    <label for="name">Pseudo: </label>
                    <input type="text" name="name" required value="{{ old('name') }}" class="@error('name') invalid @enderror"/>
                    @error("name")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="email">Email: </label>
                    <input type="email" name="email" required value="{{ old('email') }}" class="@error('email') invalid @enderror"/>
                    @error("email")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="first_name">Prenom: </label>
                    <input type="first_name" name="first_name" value="{{ old('first_name') }}" class="@error('first_name') invalid @enderror"/>
                    @error("first_name")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="last_name">Nom: </label>
                    <input type="text" name="last_name" value="{{ old('last_name') }}" class="@error('last_name') invalid @enderror"/>
                    @error("last_name")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="birth">Date de naissance: </label>
                    <input type="date" name="birth" value="{{ old('birth') }}" class="@error('birth') invalid @enderror"/>
                    @error("birth")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <legend>Genre:</legend>
                    <div id=genre value="{{ old('gender') }}" class="@error('gender') invalid @enderror">
                        <label for="gender">Homme </label>
                        <input type="radio" name="gender" value="male"/>
                        <label for="gender">Femme </label>
                        <input type="radio" name="gender" value="female"/>
                        <label for="gender">Autre </label>
                        <input type="radio" name="gender" value="other"/>
                    </div>
                    @error("gender")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="job">Metier: </label>
                    <select name="job" id="job" class="@error('job') invalid @enderror">
                        <option value="null"></option>
                        @foreach(Job::all() as $job)
                            <option value="{{$job->id}}" @if(old('job') == $job->id) selected @endif>{{$job->name}}</option>
                        @endforeach
                    </select>
                    @error("job")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="password">Mot de passe: </label>
                    <input type="password" name="password" required class="@error('password') invalid @enderror"/>
                    @error("password")
                        <li class="error">{{ $message }}</li>
                    @enderror
                    <label for="password_confirmation">Confirmation du mot de passe: </label>
                    <input type="password" name="password_confirmation" required class="@error('password') invalid @enderror"/>
                    @error("password")
                        <li class="error">{{ $message }}</li>
                    @enderror
                </div>
                <div class="button">
                    <input type="submit" value="Inscription"/>
                </div>
            </form>
        </div>
    </div>
    </body>
</html>
