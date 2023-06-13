<?php
session_start();

$bdd = new PDO('mysql:host=localhost; dbname=livreor', 'root', 'Laplateforme.06!');


// Récupérer tous les commentaires de la table "commentaire"
$req = "SELECT commentaire.commentaire, utilisateurs.login, commentaire.date FROM utilisateurs JOIN commentaire ON commentaire.id_utilisateur = utilisateurs.id";
$commentaires = $bdd->query($req);

?>

<!DOCTYPE html>
<html>
<head>
    <!-- ... -->
</head>
<body>
    <h1>Livre d'or</h1>

    <?php 

    foreach ($commentaires as $commentaire) { 
    ?>
        <div class="commentaire">
            <p class="id_utilisateur"><?php echo $commentaire['login']; ?></p>
            <p class="commentaire"><?php echo $commentaire['commentaire']; ?></p>
            <p class="date"><?php echo $commentaire['date']; ?></p>
        </div>
    <?php } ?>

    <div class="container">
        <div class="text-frame">
            <form method="POST" action="">
                <!-- ... -->
            </form>

            <a href="deconnexion.php">Déconnexion</a>
            <a href="profil.php">Retour au profil</a>
        </div>
    </div>
</body>
</html>
