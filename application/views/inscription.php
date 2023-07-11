<!DOCTYPE html>
<html>
<head>
    <title>Inscription</title>
</head>
<body>
    <h2>Inscription</h2>
    <?php if (isset($error)) { ?>
        <div style="color: red;"><?php echo $error; ?></div>
    <?php } ?>
    <form method="POST" action="<?php echo site_url('Login/inscription'); ?>">
        <label>Email:</label>
        <input type="text" name="email"><br><br>
        <label>Mot de passe:</label>
        <input type="password" name="mdp"><br><br>
        <label>Nom:</label>
        <input type="text" name="nom"><br><br>
        <label>Genre:</label>
        <select name="genre">
            <option value="Homme">Homme</option>
            <option value="Femme">Femme</option>
        </select><br><br>
        <label>Taille:</label>
        <select name="taille">
            <?php for ($i = 130; $i <= 250; $i++) { ?>
                <option value="<?php echo number_format($i / 100, 2); ?>"><?php echo number_format($i / 100, 2); ?></option>
            <?php } ?>
        </select><br><br>
        <label>Poids:</label>
        <select name="poids">
            <?php for ($i = 30; $i <= 250; $i++) { ?>
                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select><br><br>
        <input type="submit" value="S'inscrire">
    </form>
</body>
</html>
