<?php

$conn = mysqli_connect(
    "localhost",
    "root",
    "",
    "event_reservation"
);

if(!$conn){
    die("Connection Failed!");
}

?>

include "db_eventReservation.php";

if($_SERVER["REQUEST_METHOD"] != "POST"){
    die("Please submit the event reservation form first.");
}

$fullName = $_POST ['full_name];
