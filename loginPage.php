<?php 
session_start();

if (isset($_POST['username'])){
	if (!empty ($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['password']) ){
		$username_by_default = "PhpMyadmin";
		$email_by_default = "Myadmin@gmail.com";
        $password_by_default = "MySql12345"; 
		
		$username_entered = htmlspecialchars($_POST['username']);
		$email_entered = htmlspecialchars($_POST['email']);
		$password_entered = htmlspecialchars($_POST['password']);
    if ($username_entered = $username_by_default AND $email_entered = $email_by_default AND $password_entered = $password_entered ){
		header('location: index.html');
	}else{
		header('location: signupPage.php');
	  }
	}else{
	  $message = "Le nom d'utilisateur ou le mot de passe est incorrect.";
	}
  }

if(isset($_POST['username']) &&
   isset($_POST['email']) &&  
   isset($_POST['password'])){

      require_once "db_connexion.php";

      if (!$mysqlDsn) {
          die("Erreur : Impossible de se connecter à la base de données");
      }
      

    $username = $_POST['username'];
    $email = $_POST['email'];
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $em = "L'adresse e-mail est invalide";
      header("Location: loginIndex.php?error=$em&$data");
      exit;
  }
  
    $password = $_POST['password'];

    $data = "username=".$username;
    
    if(empty($username)){
    	$em = "User name is required";
    	header("Location: loginIndex.php");
	    exit;
    }else if(empty($email)){
         $em = "Email is required";
         header("Location: loginIndex.php");
         exit;
    }else if(empty($password)){
    	$em = "Password is required";
    	header("Location: loginIndex.php");
	    exit;
    }else {
      $password_hash = password_hash($password, PASSWORD_DEFAULT);

// plus tard, lors de la vérification du mot de passe :
if (password_verify($password, $password_hash)) {
    // le mot de passe est correct
}


      $sql = "SELECT * FROM users2 WHERE username = ? AND email = ?";
      $stmt = $mysqlDsn->prepare($sql);
      $stmt->execute([$username, $email]);
      
      if($stmt->rowCount() == 1) {
        $row = $stmt->fetch();
        // Récupérer les informations de l'utilisateur
        $id = $row['id'];
        $username = $row['username'];
        $email = $row['email'];
        $hashed_password = $row['password'];
    }
        // Vérifier si le mot de passe saisi par l'utilisateur correspond au mot de passe haché stocké dans la base de données
        if(password_verify($password, $hashed_password)) {
            // Démarrer une session pour protéger les cookies de session
            session_start();

            // Stocker les informations de l'utilisateur dans la session
            $_SESSION['id'] = $id;
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;

            // Rediriger l'utilisateur vers une page d'accueil
            header("Location: index.html");
            exit;
        }
                
             else {
               $em = "Incorect User name or password";
               header("Location: loginIndex.php");
               exit;
            }

          else {
            $em = "Incorect User name or password";
            header("Location: loginIndex.php");
            exit;
         }

      else {
         $em = "Incorect User name or password";
         header("Location: loginIndex.php");
         exit;
      }
    

else {
	header("Location: loginIndex.php");
	exit;
}
