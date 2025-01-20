<?php
session_start();

if (!isset($_SESSION['user_role']) || $_SESSION['user_role'] !== 'admin') {
    // Si l'utilisateur n'est pas admin, le rediriger vers la page de login
    header("Location: login.php");
    exit();
}


// Connexion à la base de données
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "4l_trophy";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Vérifier si l'ID est fourni via GET
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Préparer la requête SQL pour supprimer le donateur
    $sql = "DELETE FROM donateurs WHERE id = ?";

    // Utiliser une requête préparée pour éviter les injections SQL
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "Donateur supprimé avec succès.";
    } else {
        echo "Erreur : Donateur introuvable.";
    }

    $stmt->close();
} else {
    echo "Aucun ID fourni.";
}

// Redirection vers la page d'accueil après suppression
header("Location: liste_donateurs.php");
exit();

$conn->close();
?>
