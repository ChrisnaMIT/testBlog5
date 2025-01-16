<?php
session_start();

$username = null;
$password=null;

if(!empty($_POST['username']) && !empty($_POST['password'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

}


if($username && $password){

    ///si le username est libre, alors enregistrer le nouveau compte
    $host ="127.0.0.1";
    $port = "3306";
    $database = "blog-base";
    $dbUsername = "blog-base-user";
    $dbPassword = "blog-base-user";

    $pdo = new PDO("mysql:host=$host:$port;dbname=$database", $dbUsername, $dbPassword, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);

    $query = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $query->execute([
        "username"=> $username
    ]);
    $user = $query->fetch();

    if(!$user){
        header('Location: signIn.php?message=Username not found');
        exit();
    }

  if(!password_verify($password, $user['password']))
  {

      header('Location: signIn.php?message=wrong password');
      exit();
  }

  //le mdp est bon
    $_SESSION['id'] = $user['id'];
    $_SESSION['username'] = $user['username'];


    header('Location: index.php?message=welcome back '.$username);
    exit();

}





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
<?php if(!empty($_GET["message"])){ ?>

    <hr>
    <hr>
    <?= $_GET["message"] ?>

    <hr>
    <hr>
<?php } ?>
<h3>Log in</h3>

<form  method="post">
    <input type="text" name="username" id=""><br>
    <input type="password" name="password" id=""><br>
    <button type="submit">log in</button>
</form>


</body>
</html>