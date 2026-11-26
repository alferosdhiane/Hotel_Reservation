<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>DMN Hotel Receipt</title>

<style>

body{
    background:#f5f0e8;
    font-family:Georgia, serif;
    padding:40px;
}

.receipt{
    max-width:800px;
    margin:auto;
    background:white;
    padding:30px;
    border-radius:10px;
    box-shadow:0 4px 12px rgba(0,0,0,0.15);
}

.receipt h1,
.receipt h2{
    text-align:center;
    color:#49372b;
}

.receipt table{
    width:100%;
    border-collapse:collapse;
    margin-top:20px;
}

.receipt td{
    padding:12px;
    border-bottom:1px solid #ddd;
}

.alignright{
    text-align:right;
}

.total{
    font-weight:bold;
    font-size:18px;
}

.error-box{
    max-width:600px;
    margin:40px auto;
    padding:20px;
    text-align:center;
    background:#fdecea;
    border-left:6px solid red;
    border-radius:8px;
}

.print-btn{
    display:block;
    margin:30px auto;
    padding:12px 25px;
    border:none;
    background:#80634b;
    color:white;
    cursor:pointer;
    border-radius:6px;
}

.print-btn:hover{
    background:#49372b;
}

</style>

</head>
<body>

<?php


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

if($guests < $minGuests || $guests > $maxGuests){

    echo 
        <div class='error-box'>
        <h3>Reservation Failed</h3>
        <p>
            $eventType requires a minimum of $minGuests and a maximum of $maxGuests guests.
        </p>
      </div>
            ";

    exit;
}

$sql = "INSERT INTO event_reservation
(
full_name,
email_address,
contact_number,
event_type,
event_date,
event_time,
number_of_guests,
preferred_venue,
catering_preference,
special_request
)
VALUES
(
'$fullName',
'$email',
'$contact',
'$eventType',
'$eventDate',
'$eventTime',
'$guests',
'$venue'
'$catering'
'$specialRequest'
)";

mysqli_query($conn, $sql);
echo "Receipt...";
?>
<div class="receipt">
    <h1>DMN HOTEL</h1>
    <h2>BOOKING RECEIPT</h2>
    <hr>
     <p><strong>Full Name:</strong>
        <?php echo htmlspecialchars($fullName); ?>
    </p>

    <p><strong>Email Address:</strong>
        <?php echo htmlspecialchars($email); ?>
    </p>

    <p><strong>Contact Number:</strong>
        <?php echo htmlspecialchars($contact); ?>
    </p>

    <p><strong>Issued On:</strong>
        <?php echo date("F d, Y h:i A"); ?>
    </p>

    <table>

        <tr>
            <td>Event Type</td>
            <td class="alignright">
                <?php echo htmlspecialchars($eventType); ?>
            </td>
        </tr>

        <tr>
            <td>Event Date</td>
            <td class="alignright">
                <?php echo date("F d, Y", strtotime($eventDate)); ?>
            </td>
        </tr>

        <tr>
            <td>Event Time</td>
            <td class="alignright">
                <?php echo date("h:i A", strtotime($eventTime)); ?>
            </td>
        </tr>
        <tr>
            <td>Number of Guests</td>
            <td class="alignright">
                <?php echo $guests; ?>
            </td>
        </tr>

        <tr>
            <td>Guest Capacity</td>
            <td class="alignright">
                <?php echo $minGuests . " - " . $maxGuests; ?> Guests
            </td>
        </tr>

        <tr>
            <td>Preferred Venue</td>
            <td class="alignright">
                <?php echo htmlspecialchars($venue); ?>
            </td>
        </tr>

        <tr>
            <td>Catering Preference</td>
            <td class="alignright">
                <?php echo htmlspecialchars($catering); ?>
            </td>
        </tr>

        <tr>
            <td>Special Request</td>
            <td class="alignright">
                <?php
                if(!empty($specialRequest)){
                    echo nl2br(htmlspecialchars($specialRequest));
                }
                else{
                    echo "None";
                }
                ?>
            </td>
        </tr>

    </table>

    <br>

    <p><strong>Reservation Status:</strong> Pending Confirmation</p>
    <p style="text-align:center; color:#80634b;">
        Thank you for choosing DMN Hotel!
    </p>

</div>

<button class="print-btn" onclick="window.print()">
    Print Receipt
</button>

</body>
</html>







