<?php 
	//	Traitement du formulaire d'authentification s'il a été soumis
session_start();
    if(!array_key_exists('blog', $_SESSION))
    {
        header('Location: connexion.php');
        exit;
    }
else
{
    
    if(isset($_SESSION['blog']))
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
		$query = 'SELECT * FROM writers WHERE id = :username';
		$sth = $dbh->prepare($query);
		$sth->bindValue(':username', $_SESSION['blog'], PDO::PARAM_INT);
		$sth->execute();
        $user = $sth->fetch();
        require 'profil.phtml';
    }
    
}