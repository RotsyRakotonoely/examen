<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <header>
        <h2>Bienvenue, <?php echo isset($user['nom']) ? $user['nom'] : ''; ?></h2>
        <p>Genre: <?php echo isset($user['genre']) ? $user['genre'] : ''; ?></p>
        <p>Taille: <?php echo isset($user['taille']) ? $user['taille'] : ''; ?></p>
        <p>Poids: <?php echo isset($user['poids']) ? $user['poids'] : ''; ?></p>
        <p>Solde du portefeuille: <?php echo isset($solde) ? $solde . ' Ar' : '0 Ar'; ?></p>
    </header>
    <section>
        <h2>Suggestions de régime:</h2>
        <table>
            <tr>
                <th>Régimes</th>
                <th>Sports</th>
                <th>Variation de poids</th>
                <th>Durée</th>
            </tr>
            <?php foreach ($plus as $suggestion) { ?>
            <tr>
                <td><?php echo isset($suggestion['NomSakafo']) ? $suggestion['NomSakafo'] : ''; ?></td>
                <td><?php echo isset($suggestion['NomSport']) ? $suggestion['NomSport'] : ''; ?></td>
                <td><?php echo isset($suggestion['variation']) ? $suggestion['variation'] . ' Kg' : ''; ?></td>
                <td><?php echo isset($suggestion['duree']) ? $suggestion['duree'] . ' jours' : ''; ?></td>
            </tr>
            <?php } ?>
        </table>
    </section>
    <!-- Autres contenus de la page d'accueil -->
    <section>
    <h2>Ajouter de l'argent</h2>
    <form method="post" action="<?php echo site_url('Suggestion/ajouter_argent'); ?>">
        <input type="text" name="code" placeholder="Entrez votre code">
        <button type="submit">Ajouter</button>
    </form>
    <?php if ($this->session->flashdata('error')) { ?>
        <p><?php echo $this->session->flashdata('error'); ?></p>
    <?php } ?>
</section>

    
    <!-- Autres contenus de la page d'accueil -->
    <form method="POST" action="<?php echo site_url('Login/logout'); ?>">
        <input type="submit" value="Déconnexion">
    </form>
</body>
</html>
