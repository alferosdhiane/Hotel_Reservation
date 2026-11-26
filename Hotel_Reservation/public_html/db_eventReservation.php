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

$fullName = $_POST ['full_name'];
$email = $_POST ['email_address'];
$contact = $_POST['contact_number'];
$eventType = $_POST['event_type'];
$eventDate = $_POST['event_date'];
$eventTime = $_POST['event_time'];
$guests = (int)$_POST['number_of_guests'];
$venue = $_POST['preferred_venue'];
$catering = $_POST['catering_preference'];
$specialRequest = $_POST['special_request'];

if($eventType == "Wedding Celebration"){
    $minGuests = 100;
    $maxGuests = 200;
}elseif($eventType == "Birthday Celebration"){
    $minGuests = 30;
    $maxGuests = 80;
}elseif($eventType == "Special Celebration"){
    $minGuests = 40;
    $maxGuests = 100;
}elseif($eventType == "Corporate Meeting"){
    $minGuests = 20;
    $maxGuests = 60;
}elseif($eventType == "Private Dinner"){
    $minGuests = 10;
    $maxGuests = 30;
}else{
    die("Invalid Event Type.");
}
