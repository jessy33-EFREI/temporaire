<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "admin";
$password = "admin";
$dbname = "4l_trophy";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Requête pour récupérer les infos de l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $user = $result->fetch_assoc();

        // Vérifier le mot de passe
        if (password_verify($password, $user['password_hash'])) {
            // Authentification réussie, définir la variable de session
            $_SESSION['user_role'] = $user['role'];

            // Redirection vers index.php
            header("Location: liste_donateurs.php");
            exit();
        } else {
            echo "Mot de passe incorrect.";
        }
    } else {
        echo "Utilisateur non trouvé.";
    }

    $stmt->close();
}

$conn->close();
?>
<!-- Formulaire de connexion -->
<form method="POST">
    Nom d'utilisateur: <input type="text" name="username" required>
    Mot de passe: <input type="password" name="password" required>
    <button type="submit">Se connecter</button>
</form>
