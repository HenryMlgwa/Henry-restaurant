<?php
// Vérifier que l'utilisateur est connecté
session_start();
if (!isset($_SESSION['is_admin'])) {
    header('Location: RestaurantPage.html');
    exit;
}

include "db_connexion.php";

// Traitement des demandes de l'utilisateur

if (isset($_POST['add_dish'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $sql = "INSERT INTO dishes (name, price) VALUES (:name, :price)";
    $stmt = $mysqlDsn->prepare($sql);
    $stmt->bindParam(':name', $name);
    $stmt->bindParam(':price', $price);
    if ($stmt->execute()) {
        echo "Dish added successfully.";
    } else {
        echo "Error adding dish: " . $stmt->errorInfo()[2];
    }
}

if (isset($_POST['delete_dish'])) {
    $id = $_POST['id'];
    $sql = "DELETE FROM dishes WHERE id=:id";
    $stmt = $mysqlDsn->prepare($sql);
    $stmt->bindParam(':id', $id);
    if ($stmt->execute()) {
        echo "Dish deleted successfully.";
    } else {
        echo "Error deleting dish: " . $stmt->errorInfo()[2];
    }
}

if (isset($_POST['update_hours'])) {
    $weekday = $_POST['weekday'];
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];
    $sql = "UPDATE opening_hours SET opening_time=:opening_time, closing_time=:closing_time WHERE weekday=:weekday";
    $stmt = $mysqlDsn->prepare($sql);
    $stmt->bindParam(':weekday', $weekday);
    $stmt->bindParam(':opening_time', $opening_time);
    $stmt->bindParam(':closing_time', $closing_time);
    if ($stmt->execute()) {
        echo "Opening hours updated successfully.";
    } else {
        echo "Error updating opening hours: " . $stmt->errorInfo()[2];
    }
}

if (isset($_POST['update_date'])) {
    $date = $_POST['date'];
    $opening_time = $_POST['opening_time'];
    $closing_time = $_POST['closing_time'];
    $sql = "UPDATE opening_hours SET opening_time=:opening_time, closing_time=:closing_time WHERE weekday IS NULL AND date=:date";
    $stmt = $mysqlDsn->prepare($sql);
    $stmt->bindParam(':date', $date);
    $stmt->bindParam(':opening_time', $opening_time);
    $stmt->bindParam(':closing_time', $closing_time);
    if ($stmt->execute()) {
        echo "Opening hours updated successfully.";
    } else {
        echo "Error updating opening hours: " . $stmt->errorInfo()[2];
    }
}

// Afficher la liste des plats
$sql = "SELECT * FROM dishes";
$stmt = $mysqlDsn->prepare($sql);
if ($stmt) {
    $dishes = $stmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($dishes as $dish) {
        echo $dish['name'] . " - " . $dish['price'] . "<br>";
    }
} else {
    echo "Error retrieving dishes: " . $pdo->errorInfo()[2];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'administration du restaurant</title>
</head>
<body>
    <h1>Bienvenue sur la page d'administration du restaurant</h1>
    <h2>Liste des plats</h2>
    <table>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Prix</th>
            <th>Actions</th>
        </tr>
        <?php while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            echo "<tr>";
                     echo "<td>" . $row['id'] . "</td>";
                     echo "<td>" . $row['name'] . "</td>";
                     echo "<td>" . $row['price'] . "</td>";
            } ?>
            <td>
                <form method="post" action="">
                    <input type="hidden" name="id" value="<?= $row['id'] ?>">
                    <input type="submit" name="delete_dish" value="Supprimer">
                </form>
            </td>
        </tr>
        <!--?php endwhile; ?-->
    </table>

    <h2>Ajouter un plat</h2>
    <form method="post" action="">
        <label for="name">Nom :</label>
        <input type="text" name="name" id="name">
        <br>
        <label for="price">Prix :</label>
        <input type="text" name="price" id="price">
        <br>
        <input type="submit" name="add_dish" value="Ajouter">
    </form>

    <!-- Openning Time -->
    <h3>Horaires d'ouverture</h3>
    <p>Remplissez les champs ci-dessous pour modifier les horaires d'ouverture du restaurant.</p>
    <form method="post" action="">
        <label for="weekday">Jour de la semaine :</label>
        <select name="weekday" id="weekday">
            <option value="monday">Lundi</option>
            <option value="tuesday">Mardi</option>
            <option value="wednesday">Mercredi</option>
            <option value="thursday">Jeudi</option>
            <option value="friday">Vendredi</option>
            <option value="saturday">Samedi</option>
            <option value="sunday">Dimanche</option>
        </select>
        <br>
        <label for="opening_time">Heure d'ouverture :</label>
        <input type="time" name="opening_time" id="opening_time">
        <br>
        <label for="closing_time">Heure de fermeture :</label>
        <input type="time" name="closing_time" id="closing_time">
        <br>
        <input type="submit" name="update_hours" value="Modifier">
    </form>






    <a href="logoutPage.php">Déconnexion</a>
</body>
</html>

<?php
// Fermer la connexion à la base de données
$pdo = null;
?>
