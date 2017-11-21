<h3>Nouveau mot de passe</h3>
<?= $messageErreur; ?>
<form action="" method="POST">
    <fieldset>

        <label>Mot de passe</label><br>
        <input required type="text" name="saisieMotDePasse" placeholder="Mot de passe" ><br>
        <small>8 caractères minimum</small><br>
        <br>

        <label>Confirmation</label><br>
        <input required type="text" name="saisieMotDePasse2" placeholder="Mot de passe" ><br>
        <br>

    </fieldset>
    <input type="submit" value="Nouveau mot de passe">
</form>
