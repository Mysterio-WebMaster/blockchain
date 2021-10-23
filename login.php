<?php

include "connect.php";
session_start();

if(isset($_SESSION['email']))
{
    header("Location:index.php");
}
else
{
    if(isset($_POST['login']))
    {
        $email = $_POST['email'];
        $pass = $_POST['password'];
        $passhash = password_hash($pass, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM userreg WHERE email = '$email'";
        $query = mysqli_query($conn, $sql);
        if(mysqli_num_rows($query) > 0)
        {
            $row = mysqli_fetch_assoc($query);
            if(password_verify($pass, $row['password']))
            {
                $_SESSION['email'] = $email;
                $_SESSION['pass'] = $passhash;
                header("Location: index.php");
                echo '<div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                        Great
                    </div>';
            }
            else
            {
                echo mysqli_error($conn);
                echo '<div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
            Incorrect Username or Password
          </div>';
            }
        }
        else
        {
            echo '<div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
            Incorrect Username or Password
          </div>';
            
        }
        
    }
}

    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.6.0/font/bootstrap-icons.css">
    <!-- Bootstrap END -->

    <!-- ANimate -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
    <!-- ANimate END -->

    <!-- CSS -->
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/style.responsive.css">
    <!-- CSS END -->

    <title>Login</title>
</head>
<body class="lbg">
    
    <div class="layer"></div>

<div class="login-box">
    <div class="animate__animated animate__fadeIn">
        <h3>Login</h3>

        <form action="login.php" method="POST" >
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="password" name="password" placeholder="Password" required><br>
            <button type="submit" name="login">Login</button>
        </form>

        <p><a href="#">Forgot Username/Password?</a></p>
        <p><a href="signin.php">Register Now<i class="bi bi-arrow-right"></i></a></p>

    </div>
</div>

</body>
</html>