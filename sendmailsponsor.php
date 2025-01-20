<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = htmlspecialchars($_POST['nom']);
    $email = htmlspecialchars($_POST['email']);
    $telephone = htmlspecialchars($_POST['telephone']);
    $message = htmlspecialchars($_POST['message']);

    // Définir les détails de l'email
    $to = "sponsors@4laventure.fr";
    $subject = "Demande de contact sponsor - 4L Trophy";
    $body = "Bonjour !\n \n Vous avez reçu une nouvelle demande de sponsor : \n Nom: $nom\nEmail: $email\nTéléphone: $telephone\n\nMessage:\n$message";
    $headers = 'From: sponsors@4laventure.fr' . "\r\n" .
           'Reply-To: sponsors@4laventure.fr' . "\r\n" .
           'X-Mailer: PHP/' . phpversion();

    // Envoyer l'email
    if (mail($to, $subject, $body, $headers)) {
        echo "Votre message a été envoyé avec succès. Merci pour votre intérêt en tant que sponsor !";
    } else {
        echo "Une erreur s'est produite. Veuillez réessayer ou envoyer un mail à sponsor@4laventure.fr. \n Veuillez nous excuser pour le désagrément";
    }
} else {
    echo "Veuillez remplir tout les champs.";
}
?>
