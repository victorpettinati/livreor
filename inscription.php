<?php

$bdd = new PDO('mysql:host=localhost; dbname=livreor', 'root', 'Laplateforme.06!');

if (isset($_POST['forminscription'])) {
    if (!empty($_POST['login']) and !empty($_POST['mot_de_passe']) and !empty($_POST['mot_de_passe2'])) {
        $login = htmlspecialchars($_POST['login']);
        $mot_de_passe = sha1($_POST['mot_de_passe']);
        $mot_de_passe2 = sha1($_POST['mot_de_passe2']);

        $loginlength = strlen($login);
        if ($loginlength <= 255) {
            $reqlogin = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ?");
            $reqlogin->execute(array($login));
            $loginexist = $reqlogin->rowCount();
            if ($loginexist == 0) {
                if ($mot_de_passe == $mot_de_passe2) {
                    $insertmbr = $bdd->prepare("INSERT INTO utilisateurs(login, password) VALUES(?, ?)");
                    $insertmbr->execute(array($login, $mot_de_passe));
                    $erreur = "votre compte a bien été créé";
                } else {
                    $erreur = "Vos mots de passes ne correspondent pas !";
                }
            } else {
                $erreur = "Votre Login est déjà utilisé !";
            }
        } else {
            $erreur = "Votre login ne doit pas depasser 255 caractères.";
        }
    } else {
        $erreur = "Tous les champs doivent être complétés !";
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>

<body>
    
    <div class="container">
        

    <form>
    <a href="index.php"><p>Inscription</p></a>
        <input type="login" placeholder="Login"><br>
        <input type="password" placeholder="Mot de passe"><br>
        <input type="password" placeholder="Confirmation mot de passe" id="mot_de_passe2"name="mot_de_passe2" required><br>
        <input type="button" value="Connexion"><br>
        <a href="connexion.php">Déjà inscrit ?</a>
    </form>

    <div class="drop drop-1"></div>
    <div class="drop drop-2"></div>
    <div class="drop drop-3"></div>
    <div class="drop drop-4"></div>
    <div class="drop drop-5"></div>
    <div class="drop drop-6"></div>


    </div>
    <?php
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>

</body>

</html>