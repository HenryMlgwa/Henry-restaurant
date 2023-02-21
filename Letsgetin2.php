<?php 
session_start();

include "db_connexion.php";


if ( isset($_POST['username']) && $_POST['email'] && $_POST['password']){
	
	$username = $_POST['username'];
	$email = $_POST['email'];
	$password = $_POST['password'];
	if ( !empty($username) && !empty($email) && !empty($password)){
		
		
		
		// hash le mot de passe
		$hashed_password = md5($password);
		
		// Vérifiez si l'email existe déjà dans la base de données
		$stmt = $mysqlDsn->prepare('SELECT COUNT(*) FROM users WHERE email = :email');
		$stmt->execute(array('email' => $email));
		$count = $stmt->fetchColumn();
		if ($count > 0) {
			// Si l'email existe déjà, afficher un message d'erreur
			echo 'Cet e-mail est déjà utilisé. Veuillez en choisir un autre.';
		} else {
			// Sinon, insérer l'utilisateur dans la base de données
			$sql = "INSERT INTO users (username, email, password) VALUES (:username, :email, :password)";
			// Prepare the statement and bind parameters
			$stmt = $mysqlDsn->prepare($sql);
			$stmt->bindParam(':username', $username, PDO::PARAM_STR);
			$stmt->bindParam(':email', $email, PDO::PARAM_STR);
			$stmt->bindParam(':password', $hashed_password, PDO::PARAM_STR);
			
			// Execute the statement inside a transaction
			$mysqlDsn->beginTransaction();
			try {
				$stmt->execute();
				$mysqlDsn->commit();
				
				echo"<script> alert('Your account has been created successfully'); </script>";
				
				// Étape 3 : Redirection vers une autre page
				header('Location: RestaurantPage.html');
				
				// Étape 4 : Arrêt du script
				exit();  
			} catch (PDOException $e) {
				$mysqlDsn->rollback();
				echo "Error: " . $e->getMessage();
			}
		}
		
	}else{
		die("Veuillez remplir tous les champs");

	}
}else{
	die("Le formulaire n'est pas rempli");
}