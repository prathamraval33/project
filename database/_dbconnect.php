<?php
$server="localhost";
$username="root";
$password="";
$database="userinfo10";

$conn= mysqli_connect($server,$username,$password,$database);
if($conn)
{
    echo"CONNECTION WAS SUCCESSFULL !!!";

}
else
{
    echo"ENABLE TO CONNECT WITH SERVER !!!";
}

?>