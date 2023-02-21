<?php
// Connexion à la base de données
$host = 'localhost';
$username = 'root';
$password = '';
$dbname = 'database_hry_restaurant';

$mysqlDsn = new PDO("mysql:host=localhost;dbname=database_hry_restaurant", $username );
try {
  $pdo = new PDO('mysqlDsn', username: 'root', password: '');
} catch (PDOException $PDOException) {
}

// Récupération des réservations pour le jour sélectionné
//print_r($_POST);
$guests = $_POST['guests'];
$stmt = $mysqlDsn->prepare('SELECT COUNT(*) FROM reservations WHERE guests=:guests');
$stmt->bindParam(':guests', $guests);
$stmt->execute();
$count = $stmt->fetchColumn();

if ($count >= 25) {
  // Il y a déjà 25 réservations pour cette date
  echo 'Désolé, il n\'y a plus de place pour cette date.';
} else {
  // Insertion de la nouvelle réservation
  // Assume $pdo is a PDO instance connected to the database

$name = filter_var($_POST['name'], );
$email = filter_var($_POST['email'], );
$date = filter_var($_POST['date'], );
$guests = filter_var($_POST['guests'], );
$time = filter_var($_POST['time'], );

// Prepare the SQL statement using placeholders
$sql = "INSERT INTO reservations (name, email, guests, date, time) VALUES (:name, :email, :guests, :date, :time)";

// Prepare the statement and bind parameters
$stmt = $mysqlDsn->prepare($sql);
$stmt->bindParam(':name', $name, PDO::PARAM_STR);
$stmt->bindParam(':email', $email, PDO::PARAM_STR);
$stmt->bindParam(':guests', $guests, PDO::PARAM_INT);
$stmt->bindParam(':date', $date, PDO::PARAM_STR);
$stmt->bindParam(':time', $time, PDO::PARAM_STR);

// Execute the statement inside a transaction
$mysqlDsn->beginTransaction();
try {
  $stmt->execute();
  $mysqlDsn->commit();
  echo "Votre réservation a été enregistrée, nous vous remercions.!";
  echo '<a href="RestaurantPage.html">Revenir sur la page du restaurant</a> ';
  
} catch (PDOException $e) {
  $mysqlDsn->rollback();
  echo "Error: " . $e->getMessage();
}
}
?>
