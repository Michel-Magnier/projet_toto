<h3>Sign up</h3>
<?= $messageErreur; ?>
<form action="" method="POST">
    <fieldset>


        <label>Email</label><br>
        <input type="text" name="saisieEmail" placeholder="Email" ><br>
        <small>Nous n'allons jamais partager votre adresse email avec qui que ce soit.</small><br>
        <br>

        <label>Mot de passe</label><br>
        <input required type="text" name="saisieMotDePasse" placeholder="Mot de passe" ><br>
        <small>8 caractères minimum</small><br>
        <br>

        <label>Confirmation</label><br>
        <input required type="text" name="saisieMotDePasse2" placeholder="Mot de passe" ><br>
        <br>

    </fieldset>
    <input type="submit" value="Sign up">
</form>
