<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
</head>
<body>
    <header>
        <h2>Bienvenue, <?php echo isset($user['nom']) ? $user['nom'] : ''; ?></h2>
        <p>genre: <?php echo isset($user['genre']) ? $user['genre'] : ''; ?></p>
        <p>taille: <?php echo isset($user['taille']) ? $user['taille'] : ''; ?></p>
        <p>poids: <?php echo isset($user['poids']) ? $user['poids'] : ''; ?></p>
    </header>
    <section>
        <form method="POST" action="<?php echo site_url('Suggestion/gain'); ?>">
        <input type="submit" value="Gagner de poids">
    </form>


        <form method="POST" action="<?php echo site_url('Suggestion/perte'); ?>">
        <input type="submit" value="Perdre de poids">
    </form>

    </section>
    
    <!-- Autres contenus de la page d'accueil -->
    <form method="POST" action="<?php echo site_url('Login/logout'); ?>">
        <input type="submit" value="Déconnexion">
    </form>
</body>
</html>
