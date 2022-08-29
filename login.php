<?php
    session_start();

    require 'functions.php';
    if(isset($_COOKIE['login'])){
        $_SESSION["login"] = true;
    }

    if(isset($_SESSION["login"])){
        // Kalau sudah login
        header("Location: index.php");
    }

    if(isset($_POST["submit"])){
        if(login($_POST)){
            $_SESSION["login"] = true;
            if($_POST["remember"]){
                setcookie('login', 'true', time() + 60);
            }

            header("Location: index.php");
        } else{
            echo "
                <script>
                    alert('login gagal')
                </script>
            ";
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Silakan Login</h1>
    <form action="" method="post">
        <label for="username">Username</label>
        <br>
        <input type="text" name="username" id="username" autofocus>
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" id="password" autofocus>
        <br>
        <input type="checkbox" name="remember" id="remember">
        <label for="remember">Remember Me</label>
        <br><br>
        <button name="submit">Submit</button>
    </form>
</body>
</html>