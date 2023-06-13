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
    <h1><a href="index.php">Inscription</a></h1>
    <div class="container">                                                                 
        <div class="text-frame">
                        <form action="" method="POST">
                            <table>
                                <tr>
                                    <td>
                                        <label for="login">Login:</label>
                                    </td>
                                    <td>
                                        <input type="text" placeholder="Login" id="login" name="login" required>
                                    </td>
                                </tr>
                                <tr>
                                <tr>
                                    <td>
                                        <label for="mot_de_passe">Mot de passe:</label>
                                    </td>
                                    <td>
                                        <input type="password" placeholder="Mot de passe" id="mot_de_passe" name="mot_de_passe" required>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <label for="mot_de_passe2">Confirmation mot de passe:</label>
                                    </td>
                                    <td>
                                        <input type="password" placeholder="Confirmation mot de passe" id="mot_de_passe2"
                                            name="mot_de_passe2" required>
                                    </td>
                                </tr>
                                <td>
                                        <input type="submit" name="forminscription" value="S'inscrire"> <a href="connexion.php">Déjà inscrit ?
                                </td>
                            </table>
                        </form>
        </div>
    </div>
    <?php
    if (isset($erreur)) {
        echo $erreur;
    }
    ?>

</body>

</html>