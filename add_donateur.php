<?php
// Connexion à la base de données MariaDB
$servername = "localhost"; // Ou l'adresse de ton serveur MariaDB
$username = "admin";
$password = "admin";
$dbname = "4l_trophy";

// Créer une nouvelle connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nom = $_POST['nom'];
    $prenom = $_POST['prenom'];
    $tel = $_POST['tel'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $montant = $_POST['montant'] ;

    // Préparer la requête SQL pour insérer un donateur
    $sql = "INSERT INTO donateurs (nom, prenom, tel, adresse, email, montant)
            VALUES ('$nom', '$prenom', '$tel', '$adresse', '$email', '$montant')";

    if ($conn->query($sql) === TRUE) {
        // Rediriger vers la page d'accueil après insertion
        header("Location: index.html");
    } else {
        echo "Erreur: " . $sql . "<br>" . $conn->error;
    }
}

// Fermer la connexion
$conn->close();
?>