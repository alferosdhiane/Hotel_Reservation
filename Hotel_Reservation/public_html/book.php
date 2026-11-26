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

include "db_booking.php";

if($_SERVER["REQUEST_METHOD"] != "POST"){
    die("Please submit the booking form first.");
}

if($_SERVER["REQUEST_METHOD"] != "POST"){
    die("Please submit the booking form first.");
}

$roomType = $_POST['room_type'];
$guests = (int)$_POST['guests'];

if(($roomType == "standard" || $roomType == "luxury") && $guests > 2){

    echo "
    <div class='error-box'>
        <h3>Booking Failed</h3>
        <p>Maximum of 2 guests allowed for Standard and Luxury Rooms.</p>
    </div>
    ";

    exit;
}

if($roomType == "family" && $guests > 6){

    echo "
    <div class='error-box'>
        <h3>Booking Failed</h3>
        <p>Maximum of 6 guests allowed for Family Suite.</p>
    </div>
    ";

    exit;
}

/* Room Pricing */

if($roomType == "standard"){
    $price = 2499;
}
elseif($roomType == "luxury"){
    $price = 5999;
}
else{
    $price = 7499;
}

/* Calculate Stay */

$checkIn = new DateTime($_POST['check_in']);
$checkOut = new DateTime($_POST['check_out']);

$nights = $checkIn->diff($checkOut)->days;

if($nights < 1){
    $nights = 1;
}

$days = $nights + 1;

$total = $price * $nights;

$total = $price * $nights;



$guestName = $_POST['guest_name'];
$guestEmail = $_POST['guest_email'];
$checkIn = $_POST['check_in'];
$checkOut = $_POST['check_out'];
$message = $_POST['message'];

$sql = "INSERT INTO bookings
(
guest_name,
guest_email,
room_type,
check_in,
check_out,
guests,
message,
total_amount
)
VALUES
(
'$guestName',
'$guestEmail',
'$roomType',
'$checkIn',
'$checkOut',
'$guests',
'$message',
'$total'
)";

mysqli_query($conn, $sql);


echo "Receipt...";


?>

<div class="receipt">

    <h1>DMN HOTEL</h1>
    <h2>BOOKING RECEIPT</h2>

    <hr>

    <p><strong>Guest Name:</strong>
        <?php echo htmlspecialchars($_POST['guest_name']); ?>
    </p>

    <p><strong>Email:</strong>
        <?php echo htmlspecialchars($_POST['guest_email']); ?>
    </p>

    <p><strong>Issued On:</strong>
        <?php echo date("F d, Y h:i A"); ?>
    </p>

    <table>

        <tr>
            <td>Room Type</td>
            <td class="alignright">
                <?php echo ucfirst($roomType); ?> Room
            </td>
        </tr>

        <tr>
            <td>Check-In Date</td>
            <td class="alignright">
                <?php echo htmlspecialchars($_POST['check_in']); ?>
            </td>
        </tr>

        <tr>
            <td>Check-Out Date</td>
            <td class="alignright">
                <?php echo htmlspecialchars($_POST['check_out']); ?>
            </td>
        </tr>

        <tr>
            <td>Guests</td>
            <td class="alignright">
                <?php echo $guests; ?>
            </td>
        </tr>

        <tr>
            <td>Length of Stay</td>
            <td class="alignright">
                <?php echo $nights; ?> Night(s),
                <?php echo $days; ?> Day(s)
            </td>
        </tr>

        <tr>
            <td>Room Rate (Per Night)</td>
            <td class="alignright">
                ₱<?php echo number_format($price,2); ?>
            </td>
        </tr>

        <tr class="total">
            <td>Total Amount</td>
            <td class="alignright">
                ₱<?php echo number_format($total,2); ?>
            </td>
        </tr>

    </table>

    <br>

    <p><strong>Booking Status:</strong> Confirmed</p>

</div>

<button class="print-btn" onclick="window.print()">
    Print Receipt
</button>

</body>
</html>