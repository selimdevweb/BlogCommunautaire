<?php
require 'header.php';
require 'connexion.phtml';
require 'footer.php';

	//	Traitement du formulaire d'authentification s'il a été soumis
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

		//	Récupération de l'utilisateur
		$query = 'SELECT id, username, hashedPassword  FROM writers WHERE username = :username';
		$sth = $dbh->prepare($query);
		$sth->bindValue(':username', trim($_POST['username']), PDO::PARAM_STR);
		$sth->execute();
		$user = $sth->fetch();

		//	quand la connexion  est réussie…
		if($user !== false AND password_verify(trim($_POST['hashedPassword']), $user['hashedPassword']))
		{
			session_start();

			$_SESSION['profil'] = intval($user['id']);
                    
			header('Location: ./profil.php');
			exit;
		}
		else
		{	$erreur = "Identifiants incorrects";
			//	Redirection vers la page d'accueil
			echo $erreur;
			header('Location: ./connexion.php');
			exit;
		}
	}