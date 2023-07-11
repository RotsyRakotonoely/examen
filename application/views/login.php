<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>
    <h2>Login</h2>
    <?php if (isset($error)) { ?>
        <div style="color: red;"><?php echo $error; ?></div>
    <?php } ?>
    <form method="POST" action="<?php echo site_url('Login/login'); ?>">
        <label>Email:</label>
        <input type="text" name="email"><br><br>
        <label>Mot de passe:</label>
        <input type="password" name="mdp"><br><br>
        <input type="submit" value="Se connecter">
    </form>
    <a href="<?php echo base_url('Login/inscription'); ?>">s'inscrire</a>
</body>
</html>
