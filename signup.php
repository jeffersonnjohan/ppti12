<?php 
    require 'functions.php';
    session_start();
    if(!isset($_SESSION["login"])){
        // Kalau belum login
        header("Location: login.php");
    }

    if(isset($_POST["submit"])){
        if(signup($_POST) > 0){
            echo "
                <script>
                    alert('data berhasil ditambahkan')
                </script>
            ";
        } else{
            echo "
                <script>
                    alert('data gagal ditambahkan')
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
    <title>Sign Up</title>
</head>
<body>
    <h1>Silakan Sign Up</h1>
    <form action="" method="post">
        <label for="username">Username</label>
        <br>
        <input type="text" name="username" id="username" autofocus>
        <br>
        <label for="password">Password</label>
        <br>
        <input type="password" name="password" id="password" autofocus>
        <br><br>
        <button name="submit">Submit</button>
    </form>
</body>
</html>