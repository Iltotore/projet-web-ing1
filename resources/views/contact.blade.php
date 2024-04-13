<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <link rel="stylesheet" href="{{ asset('css/contact.css') }}">
    </head>
    <body>
        @foreach($errors->all() as $error)
            <div class="notif error">
                <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
                <p>{{$error}}</p>
            </div>
        @endforeach
        <div class="box">
            <div class="sign">
                <div id="title">Formulaire de contact :</div>
                <hr/>
                <form action="/contact/create" method="post">
                    @csrf
                    <div class="grill">
                        <label for="name">Nom: </label>
                        <input type="text" name="last_name" value="{{Auth::check() ? Auth::user()->last_name : "" }}" required/>
                        <label for="first_name">Prénom: </label>
                        <input type="text" name="first_name" value="{{Auth::check() ? Auth::user()->first_name : ""}}" required/>
                        <label for="email">Email: </label>
                        <input type="email" name="email" value="{{Auth::user() ? Auth::user()->email : ""}}" required/>
                        <label for="birth">Date de naissance: </label>
                        <input type="date" name="birth" value="{{Auth::user() ? Auth::user()->birth : ""}}" required/>
                        <legend>Genre: </legend>
                        <div id=genre>
                            <label for="gender">Homme </label>
                            <input type="radio" name="gender" value="male" @if(Auth::user() != null && Auth::user()->gender === 0) checked @endif />
                            <label for="gender">Femme </label>
                            <input type="radio" name="gender" value="female" @if(Auth::user() != null && Auth::user()->gender === 1) checked @endif />
                            <label for="gender">Autre </label>
                            <input type="radio" name="gender" value="null" @if(Auth::user() != null && Auth::user()->gender === null) checked @endif />
                        </div>
                        <label for="job_id">Metier: </label>
                        <select name="job_id" id="job" required>
                            <option value="null"></option>
                            @foreach(\App\Models\Job::all() as $job)
                                <option value="{{$job->id}}" @if(Auth::user() != null && Auth::user()->job_id == $job->id) selected @endif>{{$job->name}} </option>
                            @endforeach
                        </select>
                    </div> 
                    <hr/>   
                    <div class="inputsub">
                        <label for="subject">Objet: </label> 
                        <input type="text" id="subject" name="subject" maxlength="100" oninput="updateCounterSubject()" required/>
                        <div id="counterSubject">0/100</div>
                    </div>
                    <div class="inputsub">
                        <label for="content">Message: </label>
                        <textarea name="content" maxlength="1000" oninput="updateCounterContent()" required></textarea>
                        <div id="counterContent">0/1000</div>
                    </div>
                    <div class="button">
                        <input type="submit" value="Envoyer"/>
                    </div>
                </form>
            </div>
        </div>
        <script type="text/javascript"> <!-- unable to load js in file.js ; error MIME type invalid -->

            function updateCounterSubject() {
                let textarea = document.getElementsByName("subject")[0];
                let charCount = document.getElementById("counterSubject");
                let maxChars = parseInt(textarea.getAttribute("maxlength"));

                if (textarea.value.length > maxChars) {
                    textarea.value = textarea.value.substring(0, maxChars);
                }
                charCount.textContent = textarea.value.length + "/" + maxChars;
            }

            function updateCounterContent() {
                let textarea = document.getElementsByName("content")[0];
                let charCount = document.getElementById("counterContent");
                let maxChars = parseInt(textarea.getAttribute("maxlength"));

                if (textarea.value.length > maxChars) {
                    textarea.value = textarea.value.substring(0, maxChars);
                }
                charCount.textContent = textarea.value.length + "/" + maxChars;
            }

        </script>
    </body>
</html>
