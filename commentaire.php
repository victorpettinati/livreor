<?php
session_start();

$bdd = new PDO('mysql:host=localhost; dbname=livreor', 'root', 'Laplateforme.06!');

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['login'])) {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header("Location: connexion.php");
    exit();
}

$req = $bdd->prepare("SELECT id FROM utilisateurs WHERE login = ?");
$req->execute(array($_SESSION['login']));
$user = $req->fetch();
$id_utilisateur = $user['id'];

// Traitement du formulaire de commentaire
if (isset($_POST['formcommentaire'])) {
    if (!empty($_POST['commentaire'])) {
        $commentaire = htmlspecialchars($_POST['commentaire']);
        $login = $_SESSION['login'];

        // Insérer le commentaire dans la base de données
        $insertCommentaire = $bdd->prepare("INSERT INTO commentaire(id_utilisateur, commentaire, date) VALUES (?, ?, NOW())");
        $insertCommentaire->execute(array($id_utilisateur, $commentaire));

        $message = "Votre commentaire a été ajouté avec succès.";
    } else {
        $erreur = "Veuillez remplir le champ de commentaire.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Commentaire</title>
</head>
<body>
    <h1>Laisser un commentaire</h1>
    
    <?php if (isset($message)) { ?>
        <p><?php echo $message; ?></p>
    <?php } ?>
    
    <?php if (isset($erreur)) { ?>
        <p><?php echo $erreur; ?></p>
    <?php } ?>

    <div class="container">
        <div class="text-frame">
            <form method="POST" action="">
                <label for="commentaire">Commentaire :</label><br>
                <textarea id="commentaire" name="commentaire" rows="4" required></textarea><br>
                <input type="submit" name="formcommentaire" value="Ajouter le commentaire">
            </form>
            <a href="profil.php">Retour au profil</a>
        </div>
    </div>
</body>
</html>
