<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verifying Owner Data</title>
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
        <legend>Verifying Owner Data</legend>
        <div class='form'>
            <label for='ownerfname'>Pet Owner's First Name</label>
            <input type='text' name='ownerfname' required> 
        </div>

        <div class='form'>
            <label for='ownerlname'>Pet Owner's Last Name</label>
            <input type='text' name='ownerlname' required>
        </div>

        <div class='form'>
            <label for='ownerid'>Pet Owner's ID</label>
            <input type='text' name='ownerid' required>
        </div>

        <div id="btn">
            <input type="submit" class="btn" id="btn1" value="Submit">
        </div>
    </fieldset>
</form>



<?php
error_reporting(0);
//session
$_SESSION['ownerfname'] = $_POST['ownerfname'];
$_SESSION['ownerlname'] = $_POST['ownerlname'];
$_SESSION['ownerid'] = $_POST['ownerid'];

//connection
include 'signin.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'SELECT* FROM Petowner WHERE firstname = \''.mysqli_real_escape_string($con, $_POST['ownerfname']).'\''.' AND lastname = \''.mysqli_real_escape_string($con, $_POST['ownerlname']).'\''.' AND id = '.mysqli_real_escape_string($con, $_POST['ownerid']);
$result = mysqli_query($con, $sql);

if (mysqli_num_rows($result) == 0) {
    echo "<script type='text/javascript'>alert('Pet owner cannot be found. Recheck data entered otherwise you need to create an account for pet owner.')</script>";
}

else {
    header('Location:reservation_form.php');
}
mysqli_close($con);
?>
</body>
</html>