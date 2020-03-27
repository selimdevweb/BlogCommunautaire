<?php

    session_start();
    if(!array_key_exists('profil', $_SESSION))
    {
        header('Location: connexion.php');
        exit;
    }
    else
    {
		include('./bdd.php');
		$query = 'SELECT * FROM posts WHERE writerId = ?';
		$sth = $dbh->prepare($query);
		$sth -> bindValue(1, $_SESSION['profil'], PDO::PARAM_INT);
		$sth->execute();
		$articles = $sth->fetchAll();

		include './profil.phtml';
    }
    
