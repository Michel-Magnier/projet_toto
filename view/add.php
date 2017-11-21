<h3>Ajout d'un étudiant</h3>
<form id= "formulaireAjoutEtudiant" action="" method="POST">
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
        <select name="saisieSession" >
            <?php foreach($resultatSessions as $maSession) : ?>
                <option value="<?php echo $maSession['ses_number']; ?>"><?php echo $maSession['ses_number']; ?></option>
            <?php endforeach ?>>
        </select>
        <br>

        <label>Ville</label><br>
        <select name="saisieVille" >
            <?php foreach($resultatVilles as $maVille) : ?>
                <option value="<?php echo $maVille['cit_id']; ?>"><?php echo $maVille['cit_name']; ?></option>
            <?php endforeach ?>>
        </select>
        <br>

        <label>Image</label><br>
        <p>No file chosen</p><br>

    </fieldset>
    <input type="submit" value="Ajouter">
</form>
<div id="retourAjoutEtudiant">
</div>
