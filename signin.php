<?php
session_start();
include "connect.php";

if(isset($_SESSION['email']))
{
    header("Location:index.php");
}
else
{
    if(isset($_POST['signin']))
    {
        $name = $_POST['username'];
        $mobile = $_POST['mobile'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['pass'];
        $uniqueID = crypt($name, $mobile);


    


        $cryptmob = crypt($mobile, $name);
        $cryptaddress = crypt($address, $name);
        $passhash = password_hash($password, PASSWORD_DEFAULT);

        $verify = "SELECT * FROM userreg WHERE email= '$email'";
        $query = mysqli_query($conn, $verify);
        
        if(mysqli_num_rows($query) > 0)
        {
            $row = mysqli_fetch_assoc($query);
            if($email == isset($row['email']))
            {
                echo '<div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                Account Already Exist.
            </div>'; 
            }
        }
        else
        {
            $sql = "INSERT INTO userreg VALUES ('', '$uniqueID', '$name', '$cryptmob', '$email', '$cryptaddress', '$passhash', 'None')";

            if(mysqli_query($conn, $sql))
            {
                
                echo '<div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                Account Created Successfuly. Redirecting...
            </div>';
            header( "refresh:3;url=login.php" );
            }
            else
            {
                echo "Error ".mysqli_error($conn);
                
            }

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

    <title>Sign In</title>
</head>
<body class="sbg">
    <div class="layer"></div>
<div class="signin-box animate__animated animate__fadeIn">
<form action="signin.php" method="post">
    <div class="container">
        <h1>Registration</h1><br>
        <div class="row">
            <div class="col-md-4">
                <h4>Primary Details</h4><br><br><br>
                
                    <input type="text" name="username" placeholder="Full Name" required><br>
                    <input type="number" name="mobile" placeholder="Phone Number" required><br>
                    <input type="email" name="email" placeholder="Email" required><br>
                    <textarea name="address" id="" placeholder="Address" required></textarea>
                
            </div>
            <div class="col-md-4">
                <h3>Documents</h3><br>
                <h5>Adhar Card</h5><input type="number"  placeholder="Adhar Number">
                <input type="file" name="adhar" >
                <hr>
                <h5>Voter Card</h5><input type="number"  placeholder="Voter ID">
                <input type="file" name="voter">
            </div>
            <div class="col-md-4">
                <input type="checkbox">akjsdjkadjkn <br>
                <input type="password" name="pass" placeholder="Password" required><br>
            </div>
            
        </div>
    </div>
    <button type="submit" name="signin">Save</button>
</form>
</div>

<a href="login.php">Login?</a>

</body>
</html>