<?php
session_start();

$host ="127.0.0.1";
$port = "3306";
$database = "blog-base";
$dbUsername = "blog-base-user";
$dbPassword = "blog-base-user";

$pdo = new PDO("mysql:host=$host:$port;dbname=$database", $dbUsername, $dbPassword, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
]);

$id =null;
if(!empty($_GET['id']) && ctype_digit($_GET['id'])) {
    $id = $_GET['id'];
}

if(!$id){
    header('Location: index.php');
}


$query = $pdo->prepare("SELECT * FROM articles WHERE id = :id");
$query->execute([
        "id"=> $id
]);
$article = $query->fetch();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Document</title>
</head>
<body>
<hr>
<a href="index.php">Accueil</a>
<a href="new-article.php">nouvel article</a>
<a href="signIn.php">Sign In</a>
<a href="signUp.php">Sign Up</a>
<a href="signOut.php">Sign Out</a>
<h4><?php
    if(!empty($_SESSION["username"])){
        echo $_SESSION["username"];
    }

    ?></h4>
<hr>
<div class="article">
    <h3><?= $article['title'] ?></h3>
    <p><?= $article['content'] ?></p>
    <p>Auteur :  <?= $article['user_id'] ?></p>
    <a href="updateArticle.php?id=<?= $article['id'] ?>">Modifier</a>
    <a href="deleteArticle.php?id=<?= $article['id'] ?>">supprimer</a>


    <a href="index.php">Retour</a>
</div>
<hr>
</body>
</html>
