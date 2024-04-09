@php use Illuminate\Support\Facades\URL; @endphp
<body>
<h1>Inscription</h1>
<label>
    Bonjour {{ $user->first_name }} !
    Inscrivez-vous ici: {{ URL::to("/confirm?token=" . $user->registration_token) }}
</label>
</body>
