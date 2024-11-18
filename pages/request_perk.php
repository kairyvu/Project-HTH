<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Request Perks</title>
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
        <legend>Request Perks</legend>
        <div class='form'>
            <label for='new_perk'>Perks Needed</label>
            <input type='text' id='input' name='new_perk' required> 
        </div>

        <div class='form'>
            <label for='reservation_id'>Pet Reservation ID</label>
            <input type='text' name='reservation_id' required>
        </div>

        <div id="btn">
            <input type="submit" class="btn" id="btn1" value="Submit">
        </div>
    </fieldset>
</form>

<script>
var input = document.getElementById("input");
input.addEventListener("click", function(event) {
    if (!confirm("Before you add perks to a reservation are you sure that a reservation was made? If not please make a reservation.")) {
        event.preventDefault();
    }
});

var button = document.getElementById("btn1");
button.addEventListener("click", function(e) {
    if (!confirm("You are about to REQUEST Perks for your pet. Are you sure you want to do so?")) {
        e.preventDefault();
    }
});
</script>

<?php
error_reporting(0);
$newPerk = $_POST['new_perk'];
$reservationID = $_POST['reservation_id'];

//connection
include '../credential/signin.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'SELECT id, stayid FROM reservation WHERE stayid = '.mysqli_real_escape_string($con, $reservationID);
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $sql1 = 'SELECT stayid FROM perk WHERE stayid = '.mysqli_real_escape_string($con, $reservationID);
    $result1 = mysqli_query($con, $sql1);
    
    if (mysqli_num_rows($result1) == 0) {
        $sql = 'INSERT INTO perk VALUE (\''.mysqli_real_escape_string($con, $newPerk).'\', \''.mysqli_real_escape_string($con, $_SESSION['recepid']).'\', '.rand().', '.$row['id'].', '.mysqli_real_escape_string($con, $reservationID).')';
        $result = mysqli_query($con, $sql);
        
        //print out perk ID
        $sql1 = 'SELECT perkid FROM perk WHERE perks = \''.mysqli_real_escape_string($con, $newPerk).'\' AND recepid = \''.mysqli_real_escape_string($con, $_SESSION['recepid']).'\' AND id = '.$row['id'];
        $result1 = mysqli_query($con, $sql1);
        $row1 = mysqli_fetch_assoc($result1);
        $newperkid = $row1['perkid'];
        echo "<script type='text/javascript'>alert('Perk added. Your perk ID is: $newperkid')</script>";
    }

    else {
        echo "<script type='text/javascript'>alert('Perks existed. If you need to change please go to Update Perk')</script>";
    }
    
}

else {
    echo "<script type='text/javascript'>alert('Reservation ID not found')</script>";
}


?>
</body>
</html>