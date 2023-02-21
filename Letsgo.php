<?php
session_start();

if(isset($_POST['Form'])){
}include "db_connexion.php";
  if(isset($_POST['username']) &&
   isset($_POST['email']) &&  
   isset($_POST['password'])){ 
   }

    // Retrieve input values
    $username = filter_var($_POST['username']);
    $email = filter_var($_POST['email']);
    $password = filter_var($_POST['password']);
    $hashed_password = md5($password);



// Prepare and execute SQL statement using prepared statements
$stmt = $mysqlDsn->prepare('SELECT * FROM users WHERE username = ? AND email = ? AND password = ?');
$stmt->execute([$username, $email, $hashed_password]);
$result = $stmt->fetchAll(PDO::FETCH_ASSOC);

$user_found = false;
if ($result) {
    $_SESSION['username'] = $username;
    if ($result[0]["is_admin"]==true){
        $_SESSION['is_admin'] = true;
        header('Location: AdminPage.php');
    }else{
        header('Location: RestaurantPage.html');
        exit();
    }
    
} else{
    die("Aucun utilisateur n'a eté trouvé");
    var_dump($result);
}

// if (empty($username) || empty($email) || empty($password)) {
//     // Form data is missing, display error message
//     echo 'Please fill in all required fields.';
// } elseif (!$user_found) {
//     // User not found, display error message
//     echo 'Invalid username or email.';
// } elseif ($password_is_incorrect) {
//     // Password is incorrect, display error message
//     echo 'Invalid password.';
// } else {
//     // Login successful, redirect to home page
//     header('Location: index.html');
//     exit();
// }

