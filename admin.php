<?php
session_start();

// Vérifie si l'utilisateur est connecté en tant qu'administrateur
if (!isset($_SESSION['admin_logged_in'])) {
    header("Location: login.php"); // Redirige vers la page de connexion
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

// Récupérer les donateurs depuis la base de données
$sql = "SELECT id, nom, prenom, tel, adresse, email, montant FROM donateurs";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration des Donateurs</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="admin-container">
        <h1>Gestion des Donateurs</h1>
        <?php if ($result->num_rows > 0) { ?>
            <table>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Actions</th>
                </tr>
                <?php while($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row["id"]); ?></td>
                        <td><?php echo htmlspecialchars($row["nom"]); ?></td>
                        <td><?php echo htmlspecialchars($row["prenom"]); ?></td>
                        <td>
                            <a href="supprimer.php?id=<?php echo $row["id"]; ?>">Supprimer</a>
                        </td>
                    </tr>
                <?php } ?>
            </table>
        <?php } else { ?>
            <p>Aucun donateur trouvé.</p>
        <?php } ?>
    </div>
</body>
</html>

<?php
$conn->close();
?>
