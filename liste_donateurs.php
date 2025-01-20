<?php
session_start(); // Démarrer la session

// Supposons que tu as une variable de session qui indique si l'utilisateur est admin
$isAdmin = isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin';
?>

<?php
session_start();

if (isset($_SESSION['user_role'])) {
    echo '<a href="unlog.php" style="position: absolute; top: 10px; right: 10px;">Déconnexion</a>';
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Donateurs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="donateurs-container">
        <h1>Liste des Donateurs</h1>

        <div class="add-button-container">
            <a href="formulaire.php" class="add-button">Ajouter un Donateur</a>
        </div>

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

            // Récupérer les donateurs depuis la base de données
            $sql = "SELECT id, nom, prenom, tel, adresse, email, montant FROM donateurs";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Afficher chaque donateur
                while($row = $result->fetch_assoc()) {
                    echo '<div class="donateur">';
                    echo '<h2>' . htmlspecialchars($row["nom"]) . ' ' . htmlspecialchars($row["prenom"]) . '</h2>';
                    echo '<p>Montant du Don : ' . htmlspecialchars($row["montant"]) . ' €</p>';


                    // Afficher le bouton de suppression si l'utilisateur est admin
                    if ($isAdmin) {
                        echo '<p>Téléphone : ' . htmlspecialchars($row["tel"]) . '</p>';
                        echo '<p>Adresse : ' . htmlspecialchars($row["adresse"]) . '</p>';
                        echo '<p>Email : ' . htmlspecialchars($row["email"]) . '</p>';
                        echo '<a href="supprimer.php?id=' . htmlspecialchars($row["id"]) . '" class="delete-button">Supprimer</a>';
                        // Debug pour vérifier le lien généré
                    }
                    
                    echo '</div>';
                }
            } else {
                echo "0 donateurs trouvés.";
            }

            // Fermer la connexion
            $conn->close();
        ?>
    </div>
</body>
</html>
