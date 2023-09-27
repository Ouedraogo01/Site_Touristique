<?php
error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);


try {
    $contact = new PDO(
        'mysql:host=localhost;dbname=sitevoyage',
        'root',
        '',
        array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION)
    );
} catch (Exception $e) {
    die("Error " . $e->getMessage());
}

if (isset($_POST['envoyer'])) {
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    $sql = $contact->prepare("INSERT INTO inscription (nom, email, subject, message)
                VALUES (:nom, :email, :subject, :message)");

    $sql->bindParam(':nom', $nom);
    $sql->bindParam(':email', $email);
    $sql->bindParam(':subject', $subject);
    $sql->bindParam(':message', $message);
    $sql->execute();

    if ($sql->execute()) {
        echo "Votre message à bien été envoyé";
    } else {
        echo "echec, problème technique";
    }
}

$messa = "<p>Vous avez reçu un message de : <strong> " . $email . "</strong></p>
          <p><strong>Nom: </strong>" . $nom . "</p>
          <p><strong>Objet: </strong>" . $subject . "</p>
          <p><strong>Message: </strong>" . $message . "</p>
          ";

//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';


//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->isSMTP(); //Send using SMTP
    $mail->Host = 'smtp.gmail.com'; //Set the SMTP server to send through
    $mail->SMTPAuth = true; //Enable SMTP authentication
    $mail->Username = 'abouodra18@gmail.com'; //SMTP username
    $mail->Password = 'nyinhmvnmaueqpph'; //SMTP password
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
    $mail->Port = 465; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

    //Recipients
    $mail->setFrom('from@example.com', 'site');
    $mail->addAddress('abouodra18@gmail.com'); //Add a recipient

    //Content
    $mail->isHTML(true); //Set email format to HTML
    $mail->Subject = "Vous avez réçu un message de: " . $email;
    $mail->Body = $messa;
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

?>