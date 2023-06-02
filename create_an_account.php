<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Creating an account</title>
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
        <legend>Creating an account</legend>
        <div class='form'>
            <label for='create_fname'>Pet Owner's First Name</label>
            <input type='text' name='create_fname' required> 
        </div>

        <div class='form'>
            <label for='create_lname'>Pet Owner's Last Name</label>
            <input type='text' name='create_lname' required> 
        </div>

        <div class='form'>
            <label for='create_ownerid'>Pet Owner's ID</label>
            <input type='text' name='create_ownerid' required> 
        </div>

        <div id="btn">
            <input type="submit" class="btn" id="btn1" value="Submit">
        </div>
    </fieldset>
</form>

<?php
error_reporting(0);
$fname = $_POST['create_fname'];
$lname = $_POST['create_lname'];
$id = $_POST['create_ownerid'];

//connect
include 'signin.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'SELECT* FROM Petowner WHERE id = '.mysqli_real_escape_string($con, $id);
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    echo "<script type='text/javascript'>alert('Pet owner already has an account')</script>";
}

else {
    $sql = 'INSERT INTO Petowner VALUES (\''.mysqli_real_escape_string($con, $fname).'\', \''.mysqli_real_escape_string($con, $lname).'\', '.mysqli_real_escape_string($con, $id).')';
    mysqli_query($con, $sql);
    echo "<script type='text/javascript'>alert('Account is created successfully')</script>";
}

?>
</body>
</html>