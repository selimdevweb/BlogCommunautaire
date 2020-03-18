<?php 
require 'header.php';
require 'inscription.phtml';
require 'footer.php';
	//	Traitement du formulaire d'inscription s'il a été soumis
	if(!empty($_POST))
	{
		//	Connexion à la base de données
		$dbh = new PDO
		(
			'mysql:host=localhost;dbname=blog;charset=utf8',
			'root',
			'',
			[
				PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
				PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
			]
		);

		//	Ajout de l'utilisateur
		$query = 'INSERT INTO writers (username, hashedPassword
        ) VALUES (:username, :hashedPassword)';
		$sth = $dbh->prepare($query);
		$sth->bindValue(':username', trim($_POST['username']), PDO::PARAM_STR);
		$sth->bindValue(':hashedPassword', password_hash(trim($_POST['hashedPassword']), PASSWORD_BCRYPT), PDO::PARAM_STR);
		$sth->execute();

		//	Redirection vers la page d'accueil
	header('Location: ./connexion.php');
	exit;
	}

	