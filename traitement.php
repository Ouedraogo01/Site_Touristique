<?php
session_start();

function passwordHash($pass)
{
    $pass = sha1(md5($pass));
    return $pass;
}

try {
    $connexion = new PDO(
        'mysql:host=localhost;dbname=sitevoyage',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (Exception $e) {
    die("Error " . $e->getMessage());
}

// if (isset($_POST['submit'])) {
//     $email = $_POST['email'];
//     $mdp = $_POST['mdp'];
//     echo $email;
// }

// Formulaire de connexion
if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $mdp = $_POST['mdp'];

    if (!empty($email) and !empty($mdp)) {
        $mdp = passwordHash($mdp);
        $verify = $connexion->prepare("SELECT * FROM connexion WHERE email = ? AND mdp = ?");
        $verify->execute([$email, $mdp]);

        $donnee = $verify->fetch(PDO::FETCH_ASSOC);
        if ($verify->rowCount() == 1) {
            $_SESSION['connecter'] = $donnee['id'];
            $_SESSION['name'] = $donnee['email'];
            echo $_SESSION['name'];
            header("location:SiteVoyage.php");
        } else
            $return = "Adress email ou mot de passe incorrect.";
    } else
        $return = "Veillez remplir tout les champs.";
}
?>