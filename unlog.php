<?php
session_start();

// Vérifier si une session existe
if (isset($_SESSION['user_role'])) {
    // Détruire la session pour déconnecter l'utilisateur
    session_unset(); // Efface les variables de session
    session_destroy(); // Détruit la session
}

// Rediriger vers la page de connexion ou d'accueil
header("Location: index.html");
exit();
?>
