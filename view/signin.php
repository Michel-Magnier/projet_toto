<h3>Sign In</h3>
<?= $messageErreur; ?>
<form action="" method="POST">
    <fieldset>

        <label>Email</label><br>
        <input type="text" name="saisieEmail" placeholder="Email" ><br>
        <br>

        <label>Mot de passe</label><br>
        <input required type="text" name="saisieMotDePasse" placeholder="Mot de passe" ><br>
        <br>

    </fieldset>
    <input type="submit" value="Sign in">
</form>
