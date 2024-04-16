<h1>Gestionnaire formulaires de contact</h1>
@foreach($errors->all() as $error)
    <div class="notif error">
        <img src="{{ asset('img/white-cross.png') }}" alt="Croix blanche" onclick="closeWidget(this.parentNode)"/>
        <p>{{$error}}</p>
    </div>
@endforeach
<div class=manager>
    <div id="contacts_list">
        <div class="search_container">
            <img class="search_icon" src="{{ asset('img/search-icon.svg') }}" alt="Search icon">
            <input type="text" class="search_input" placeholder="Rechercher...">
        </div>
        <hr>
        <div id="contact_table">
            <table>
                <thead>
                <tr>
                    <th>Id</th>
                    <th>Subject</th>
                </tr>
                </thead>

                <tbody>
                @foreach(\App\Models\ContactForm::all() as $contact)
                    <tr onclick="displayContactDetails({{ $contact }})">
                        <td>{{ $contact->id }}</td>
                        <td>{{ $contact->subject }}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="contact_details">
        <div id="contact_details_not_loaded">
            <h2>Veuillez sélectionner un utilisateur</h2>
        </div>
        <div id="contact_details_loaded" class="hidden">

            <table>
                <tr>
                    <td>Prénom:</td><td id="first_name"></td>
                </tr>
                <tr>
                    <td>Nom:</td><td id="last_name"></td>
                </tr>
                <tr>
                    <td>mail:</td><td id="email"></td>
                </tr>
                <tr>
                    <td>Genre:</td><td id="gender"></td>
                </tr>
                <tr>
                    <td>Date de naissance:</td><td id="birthday"></td>
                </tr>
                <tr>
                    <td>Métier:</td><td id="job"></td>
                </tr>
            </table>

            <table>
                <tr>
                    <td id="subject"></td>
                </tr>
                <tr>
                    <td id="content"></td>
                </tr>
            </table>

            <form action="/admin/contact/reply" method="post" autocomplete="off">
                @csrf

                <input type="hidden" id="contact_id" name="id"/>

                <!-- response -->
                <div class="contact_details_field">
                    <label for="mailBody">Réponse :</label>
                    <textarea id="response" name="mailBody" required/>
                </div>

                <!-- Submit -->
                <div class="contact_details_field">
                    <input type="submit" value="Envoyer"/>
                </div>
            </form>

            <!-- Delete button -->
            <div class="contact_details_field">
                <form action="/admin/contact/remove" method="post">
                    @csrf
                    <input type="hidden" id="contact_id_delete" name="id"/>
                    <input type="submit" value="Supprimer"/>
                </form>
            </div>
        </div>
    </div>
</div>
