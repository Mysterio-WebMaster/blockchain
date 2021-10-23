<?php

$server = "localhost";
$user = "root";
$password = "";
$database = "vote";

$conn = mysqli_connect($server, $user, $password, $database);
if(!$conn)
{
    echo "Not connected";
}
else
{
    echo "Connected Successfully";
}

?>