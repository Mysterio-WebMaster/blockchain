<?php

include "connect.php";
session_start();

if(isset($_SESSION['email']))
{
    $email = $_SESSION['email'];
}
else
{
    header("Location:login.php");
}

if(isset($_POST['logout']))
{
    unset($_SESSION['email']);
    session_destroy();
    header("Location:login.php");
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

    <title>Home</title>
</head>
<body>
  <?php 
  
  $data = "SELECT * FROM userreg WHERE email ='$email'";

    $query = mysqli_query($conn, $data);
    if(mysqli_num_rows($query) > 0)
    {
        $row = mysqli_fetch_assoc($query);
        $name = $row['uniqueID'];
    }

  ?>

   <h4>Your Account ID: <?php echo $name;?></h4>
   <h6>Email: <?php echo $email; ?> </h6>

 <br><br>

<?php

$verify = "SELECT * FROM userreg WHERE email = '$email'";
$verifyquery = mysqli_query($conn, $verify);
if(mysqli_num_rows($verifyquery)>0)
        {
            $verifyrow = mysqli_fetch_assoc($verifyquery);
            $status = $verifyrow['vote_cast'];
        }

$getParty = "SELECT * FROM party";
$getPartyquery = mysqli_query($conn, $getParty);
    
?> 
     <table width="100%">
     <tr>
         <th>ID</th>
         <th>Party</th>
         <th>Vote</th>
     </tr>
     <tr>

<?php

if(mysqli_num_rows($getPartyquery)  > 0)
{
    while($Partyrow = mysqli_fetch_array($getPartyquery))
    {
        

?>
         <td><?php echo $Partyrow['id']; ?></td>
         <td><?php echo $Partyrow['party_name']; ?></td>
         <td>
             <?php

                if($status == "Success")
                {
             ?>
             <button disabled>Vote Now</button>
             <?php
                }
                else
                {
            ?>
             <button type="submit" onclick = "window.location.href='vote.php?page=vote&action=vote&id=<?php echo $Partyrow['id']; ?>'">Vote Now</button>
            <?php
                }

             ?>
            
        </td>
    </tr>
    

<?php
    }
}

?>

 </table>


<br><br><br>



<a href="https://gmail.com" target="blank">Request changes</a>
<form action="index.php" method="post">
    <button type="submit" name="logout">Logout</button>
</form>

</body>
</html>