<?php
//http://afcsystemm.infinityfreeapp.com/data_receiver.php?Data=2023-01-15&Temperatura=22&Num_Lab=49&Gas_Fumaca=200&Hora=09:36
include_once('db_connection.php');
date_default_timezone_set('America/Bahia');
$Data = date("Y-m-d");
$Temperatura = $_GET['Temperatura'];
$Num_Lab = $_GET['Num_Lab'];
$Gas_Fumaca = $_GET['Gas_Fumaca'];
$Hora = date("h:i:s");

mysqli_query($connection, "insert into `ocorrencias` (`Data`, `Temperatura`, `Num_Lab`, `Gas_Fumaca`, `Hora`) values ('$Data', '$Temperatura', '$Num_Lab', '$Gas_Fumaca','$Hora')"); 
echo "insert into `ocorrencias` (`Data`, `Temperatura`, `Num_Lab`, `Gas_Fumaca`, `Hora`) values ('$Data', '$Temperatura', '$Num_Lab', '$Gas_Fumaca','$Hora')";    
mysqli_close($connection);
?>