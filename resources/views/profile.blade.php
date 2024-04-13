@php use App\Models\Job; @endphp
    <!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}">
</head>
<body>
<div class="sign">
    <div id="title">
        <img src="../img/user_image.jpg"/>Votre profil :
    </div>
    <form action="/auth/update" method="post">
        @csrf
        <div class="grill">
            <label for="name">Pseudo: </label>
            <input type="text" name="name" value="{{ Auth::user()->name }}" required
                   class="@error('name') invalid @enderror"/>
            @error("name")
                <li class="error">{{ $message }}</li>
            @enderror
            <label for="email">Email: </label>
            <input type="email" name="email" value="{{Auth::user()->email}}" required
                   class="@error('email') invalid @enderror"/>
            @error("email")
                <li class="error">{{ $message }}</li>
            @enderror
            <label for="first_name">Prenom: </label>
            <input type="first_name" name="first_name" value="{{Auth::user()->first_name}}"
                   class="@error('first_name') invalid @enderror"/>
            @error("first_name")
                <li class="error">{{ $message }}</li>
            @enderror
            <label for="last_name">Nom: </label>
            <input type="text" name="last_name" value="{{Auth::user()->last_name}}"
                   class="@error('last_name') invalid @enderror"/>
            @error("last_name")
                <li class="error">{{ $message }}</li>
            @enderror
            <label for="birth">Date de naissance: </label>
            <input type="date" name="birth" value="{{Auth::user()->birth}}" class="@error('birth') invalid @enderror"/>
            @error("birth")
                <li class="error">{{ $message }}</li>
            @enderror
            <legend>Genre:</legend>
            <div id=genre class="@error('gender') invalid @enderror">
                <label for="gender">Homme </label>
                <input type="radio" name="gender" value="male" @if(Auth::user()->gender === 0) checked @endif/>
                <label for="gender">Femme </label>
                <input type="radio" name="gender" value="female" @if(Auth::user()->gender === 1) checked @endif/>
                <label for="gender">Autre </label>
                <input type="radio" name="gender" value="null" @if(Auth::user()->gender === null) checked @endif/>
            </div>
            @error("gender")
                <li class="error">{{ $message }}</li>
            @enderror
            <label for="job">Metier: </label>
            <select name="job" id="job" class="@error('job') invalid @enderror">
                <option value="null"></option>
                @foreach(Job::all() as $job)
                    <option value="{{$job->id}}"
                            @if(Auth::user()->job_id == $job->id) selected @endif>{{$job->name}} </option>
                @endforeach
            </select>
            @error("job")
                <li class="error">{{ $message }}</li>
            @enderror
            <label for="password">Mot de passe: </label>
            <input type="password" name="password" class="@error('password') invalid @enderror"/>
            @error("password")
                <li class="error">{{ $message }}</li>
            @enderror
            <label for="password_confirmation">Confirmation du mot de passe: </label>
            @error("password")
                <li class="error">{{ $message }}</li>
            @enderror
            <input type="password" name="password_confirmation" class="@error('password') invalid @enderror"/>
        </div>
        <div class="button">
            <input type="submit" value="Modifier le profil"/>
        </div>
    </form>
</div>
</body>
</html>
