<?php

$host = 'ec2-46-137-156-205.eu-west-1.compute.amazonaws.com';
$dbname = 'drf79cc20kndb';
$username = 'egfmuoqedovyvp';
$password = 'ab7cfa1ba2eda2f72a3d68cd4972086b39c207b4ef0eea2af22dac35e50b4ed8';


 $dbh = new PDO('pgsql:host=' . $host . ';dbname=' .$dbname.";charset=utf8", $username, $password);

?>
