<p>Je suis dans la page view/add.php</p>
<h3>Ajout d'un étudiant</h3>
<form action="#" method="POST">
    <fieldset>
        <label>Nom</label><br>
        <input required type="text" name="saisieNom" placeholder="Nom" value="<?= $lastName ; ?>"><br>
        <br>
        <label>Prénom</label><br>
        <input required type="text" name="saisiePrenom" placeholder="Prénom" value="<?= $firstName ; ?>"><br>
        <br>
        <label>Email</label><br>
        <input required type="email" name="saisieEmail" placeholder="Email" value="<?= $email ; ?>"><br>
        <br>
        <label>Date de naissance</label><br>
        <input required type="text" name="saisieNaissance" placeholder="Date de naissance" value="<?= $birthDate ; ?>"><br>
        <p>au format YYYY-MM-DD (2017-10-27)</p><br>
        <br>
        <label>Sympathie</label><br>
        <select name="saisieSympathie" >
            <option value="1">1 - Très Bien</option>
            <option value="2">2 - Bien</option>
            <option value="3">3 - Moyenne</option>
            <option value="4">4 - Mauvaise</option>
            <option value="5">5 - Très Mauvaise</option>
        </select>
        <br>
        <label>Session</label><br>
        <input required type="text" name="saisieSession" placeholder="choisissez"><br>
        <br>
        <label>Ville</label><br>
        <input required type="text" name="saisieVille" placeholder="choisissez"><br>
        <br>
        <label>Image</label><br>
        <p>No file chosen</p><br>

    </fieldset>
    <input type="submit" value="Ajouter">
</form>
