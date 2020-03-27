<?php

    //	Connexion à la base de données
	include('./bdd.php');

    $query = 'SELECT posts.id, posts.title, posts.image, posts.content, posts.publicationDate, post.writerId, writers.username FROM posts INNER JOIN writers ON posts.writerId = writers.id WHERE posts.writerId = ?';
    $sth = $dbh->prepare($query);
    $sth -> bindValue(1, intval($_GET['id']), PDO::PARAM_INT);
    $sth->execute();
    $article = $sth->fetch();

    $query = 'SELECT username, content, publicationDate FROM comments WHERE id = ?';
    $sth = $dbh->prepare($query);
    $sth -> bindValue(1, intval($_GET['id']), PDO::PARAM_INT);
    $sth->execute();
    $commentaires = $sth->fetchAll();

    session_start();

    include './articles.phtml';
