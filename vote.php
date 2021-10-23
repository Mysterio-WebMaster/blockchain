<?php

include "connect.php";
session_start();
if(!isset($_SESSION['email']))
{
    header("Location:login.php");
    $stat = session_status();
}


$email = $_SESSION['email'];

if(isset($_GET["action"]) && $_GET['action']=="vote")
{
    $id = intval($_GET['id']);
    $sql = "SELECT * FROM party WHERE id = '$id'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0)
    {
        $row =mysqli_fetch_assoc($query);
        $n = $row['vote_count'];
    }
    
        
        $k = $n+1;

         $upadteParty = "UPDATE party SET vote_count = '$k' WHERE id = '$id'";    
            if(mysqli_query($conn, $upadteParty))
            {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                Vote Casted Successfully.
            </div>';
            }
            else
            {
                echo '<div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                    Error
                </div>';
                echo mysqli_error($conn);
            }

            $upadteVoter = "UPDATE userreg SET vote_cast = 'Success' WHERE email = '$email'";    
            if(mysqli_query($conn, $upadteVoter))
            {
                echo '<div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
                Status Updated
            </div>';
            unset($n);  
            header("Location:index.php");
            }
            else
            {
                echo '<div class="alert alert-danger animate__animated animate__fadeInDown" role="alert">
                    Error
                </div>';
                echo mysqli_error($conn);
            }

    


}
else
{
    header("Location:index.php");
}



?>