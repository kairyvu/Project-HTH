<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cancel Pet's reservation</title>
    <link href = "../Happy Tails Hotel.css" rel="stylesheet">
    <link href="../nav.css" rel="stylesheet">
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
        <legend>Cancel Pet's reservation</legend>
        <div class='form'>
            <label for='cancel_reservation'>Reservation ID</label>
            <input type='text' name='cancel_reservation' required> 
        </div>

        <div id="btn">
            <input type="submit" class="btn" id="btn1" value="Submit">
        </div>
    </fieldset>
</form>
<script>
let button = document.getElementById('btn1');
button.addEventListener('click', function(e) {
    if (!confirm('You are about to CANCEL this reservation. Are you sure?')) {
        e.preventDefault();
    }
});
</script>
<?php
error_reporting(0);
$cancelReservation = $_POST['cancel_reservation'];

//connection
include '../credential/signin.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'SELECT stayid FROM reservation WHERE stayid = '.mysqli_real_escape_string($con, $cancelReservation);
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {

    //remove in reservation table
    $sql = 'DELETE FROM reservation WHERE stayid = '.mysqli_real_escape_string($con, $cancelReservation);
    mysqli_query($con, $sql);

    //remove in perk table
    $sql = 'DELETE FROM perk WHERE stayid = '.mysqli_real_escape_string($con, $cancelReservation);
    mysqli_query($con, $sql);
    echo "<script type='text/javascript'>alert('Reservation and Perks are Deleted')</script>";
}

else {
    echo "<script type='text/javascript'>alert('Reservation ID does not exist. Please check and re-enter the correct Reservation ID')</script>";
}

?>
    
</body>
</html>