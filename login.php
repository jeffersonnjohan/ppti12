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
            $_SESSION["username"] = $_POST["username"];
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
    <link rel="stylesheet" href="login.css">
    <title>Login</title>
</head>
<body>
    <div class="form-container">
        <div class="login-account">
            <center>Login</center> 
        </div>
        <div class="container-form">
            <form action="" method="post" id="form">
                <div class="form-input">
                    <label class="input" for="username">Username</label>
                    <input class="input-box" type="text" name="username" id="username" autofocus>
                </div>

                <br>

                <div class="form-input">
                    <label class="input" for="password">Password</label>
                    <input class="input-box" type="password" name="password" id="password" autofocus>
                </div>

                <br>

                <div class="remember">
                    <input class="checkbox" type="checkbox" name="remember" id="remember">
                    <label for="remember">Remember Me</label>
                </div>

                <div class="signup">
                    <a href="signup.php">Belum punya account?</a>
                </div>

                <button class="button-submit" name="submit">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>