<?php
session_start();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PWA</title>
</head>
<body>
<?php

if (isset($_SESSION['errors']))
{
    echo $_SESSION['errors'];
}

?>
<form action="<?= $_SERVER["PHP_SELF"]; ?>" method="POST">
    <h4>Uloguj se</h4>
    <input type="text" placeholder="username" name="username">
    <input type="password" placeholder="password" name="password">
    <input type="submit" value="login">
</form>
<?php
require_once 'db/connection.php';
extract($_POST);

if(isset($username) && isset($password))
{
    $hashed = md5($password);
    $stmt = $pdo->prepare("SELECT * FROM user WHERE username=:username and password=:password");
    $stmt->bindParam(':username', $username);
    $stmt->bindParam(':password', $hashed);
    $stmt->execute();
    $result = $stmt->fetch();
    if($result)
    {
        $_SESSION['user'] = $result;
        header('Location:./dashboard.php');
        unset($_SESSION['errors']);
    } else {
        $_SESSION['errors'] = 'Bad credentials! Please login again!';
    }

}

?>


</body>
</html>

