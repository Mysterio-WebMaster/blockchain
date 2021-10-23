<?php

include "connect.php";


$sql = "SELECT * FROM party WHERE id = '1'";
    $query = mysqli_query($conn, $sql);
    if(mysqli_num_rows($query) > 0)
    {
        $row =mysqli_fetch_assoc($query);
        $n = $row['vote_count'];
    }


    


if(isset($_POST['vote']))
{

    $n = $n+1;

    $upadte = "UPDATE party SET vote_count = '$n' WHERE id = 1";    
    if(mysqli_query($conn, $upadte))
    {
        echo '<div class="alert alert-success animate__animated animate__fadeInDown" role="alert">
        Vote Casted Successfully.
    </div>';
    unset($n);
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
    exit;
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
    <title>test</title>
</head>
<body>
    <form action="test.php" method="post">
        <button type="submit" name="vote" >Vote</button>
    </form>
</body>
</html>