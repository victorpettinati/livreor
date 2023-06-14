<?php
session_start();

$bdd = new PDO('mysql:host=localhost; dbname=livreor', 'root', 'Laplateforme.06!');

if (isset($_POST['formconnexion'])) {
    if (!empty($_POST['login']) && !empty($_POST['mot_de_passe'])) {
        $login = htmlspecialchars($_POST['login']);
        $password = sha1($_POST['mot_de_passe']);

        $req = $bdd->prepare("SELECT * FROM utilisateurs WHERE login = ? AND password = ?");
        $req->execute(array($login, $password));
        $user = $req->fetch();

        if ($user) {
            if ($login === 'admin' && $password === sha1('admin')) {
                header("Location: admin.php");
                exit();
            } else {
                $_SESSION['login'] = $user['login'];
                header("Location: profil.php");
                exit();
            }
        } else {
            $erreur = "Identifiant ou mot de passe incorrect.";
        }
    } else {
        $erreur = "Veuillez remplir tous les champs.";
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
    <title>Page de Connexion</title>
</head>
<body>
                                                                <?php if (isset($erreur)) { ?>
                                                                    <p><?php echo $erreur; ?></p>
                                                                <?php } ?>
    <div class="container">                                                                 
    <form action="" method="POST">
    <a href="index.php"><p>Se connecter</p></a>
        <input type="text" placeholder="Login" id="login" name="login"><br>
        <input type="password" placeholder="Mot de passe" id="mot_de_passe" name="mot_de_passe"><br>
        <input type="submit" name="formconnexion"  value="Connexion"><br>
        <a href="inscription.php">S'inscrire</a>
    </form>


    <div class="drop drop-1"></div>
    <div class="drop drop-2"></div>
    <div class="drop drop-3"></div>
    <div class="drop drop-4"></div>
    <div class="drop drop-5"></div>
    <div class="drop drop-6"></div>


    </div>
    </div>
</body>
</html>

