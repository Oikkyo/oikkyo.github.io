
<?php

$username = $_GET['name'];
$userstorename = $_GET['storename'];
$userphone = $_GET['phone'];

$link = mysqli_connect('oikkyo-wishregdb-instance.ctncqewqxjhv.ap-south-1.rds.amazonaws.com', 'neelabjaroy95', 'Neelabjaroy21995','initial_oikkyowishreg_db');

// Check connection
if (mysqli_connect_errno())
  {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
  }

// Check if server is alive
if (mysqli_ping($link))
  {
  echo "Connection is ok!";
  }
else
  {
  echo "Error: ". mysqli_error($link);
  }




 mysqli_query($link,"INSERT INTO table (`name`, `storename`, `phone`) VALUES ('$username', '$userstorename', '$userphone')") 
 or die(mysqli_error($link));


  echo "Entered data successfully\n";


mysqli_close($link);
?>