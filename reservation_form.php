<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book a reservation</title>
    <link href = "Happy Tails Hotel.css" rel="stylesheet">
    <link href="nav.css" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <ul>
            <li class="nav"><a href="display_database.php">Receptionist's Account</a></li>
            <li class="nav"><a href="book_a_reservation.php">Book A Stay</a></li>
            <li class="nav"><a href="cancel_reservation.php">Cancel A Stay</a></li>
            <li class="nav"><a href="request_perk.php">Request Additional Perks</a></li>
            <li class="nav"><a href="cancel_perks.php">Cancel Perks</a></li>
            <li class="nav"><a href="perk_update.php">Update Perks</a></li>
            <li class="nav"><a href="create_an_account.php">Create New Client Account</a></li>
        </ul>
    </nav>
</header><br><br><br>

<form method='post'>
    <fieldset>
        <legend>Book a reservation</legend>
        <div class='form'>
            <label for='newcheckin'>Pet's Check In Date</label>
            <input type='date' name='newcheckin' required> 
        </div>

        <div class='form'>
            <label for='newcheckout'>Pet's Check Out Date</label>
            <input type='date' name='newcheckout' required> 
        </div>

        <div class='form'>
            <label for='newaddress'>Pet's Address and Phone Number</label>
            <input type='text' name='newaddress' required> 
        </div>

        <div class='form'>
            <label for='newpetname'>Pet's Name and Type</label>
            <input type='text' name='newpetname' required> 
        </div>

        <div id="btn">
            <input type="submit" class="btn" id="btn1" value="Submit">
        </div>
    </fieldset>
</form>

<?php
error_reporting(0);
$newcheckin = $_POST['newcheckin'];
$newcheckout = $_POST['newcheckout'];
$newaddress = $_POST['newaddress'];
$newpetname = $_POST['newpetname'];

//connection
include 'signin.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'INSERT INTO reservation VALUES (\''.mysqli_real_escape_string($con, $newpetname).'\', \''.mysqli_real_escape_string($con, $newaddress).'\', \''.mysqli_real_escape_string($con, $newcheckin).'\', \''.mysqli_real_escape_string($con, $newcheckout).'\', '.rand().', '.mysqli_real_escape_string($con, $_SESSION['ownerid']).', '.mysqli_real_escape_string($con, $_SESSION['recepid']).')';
if (mysqli_query($con, $sql) == true) {
    echo "<script type='text/javascript'>alert('Reservation is booked')</script>";
}

else {
    echo "<script type='text/javascript'>alert('Failed to book a reservation. Please try again.')</script>";
}

mysqli_close($con);
?>
</body>
</html>