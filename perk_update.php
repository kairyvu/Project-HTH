<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Perk</title>
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
        <legend>Update Perk</legend>
        <div class='form'>
            <label for='perk_update'>Update Perks</label>
            <input type='text' name='perk_update' required> 
        </div>

        <div class='form'>
            <label for='reservation_id_perk'>Reservation ID</label>
            <input type='text' name='reservation_id_perk' required> 
        </div>

        <div class='form'>
            <label for='perk_id_perk'>Pet's Perk ID</label>
            <input type='text' name='perk_id_perk' required>
        </div>

        <div id="btn">
            <input type="submit" class="btn" id="btn1" value="Submit">
        </div>
    </fieldset>
</form>
<script>
var button = document.getElementById("btn1");
button.addEventListener("click", function(e) {
    if (!confirm("You are about to UPDATE Perks for your pet. Are you sure you want to do so?")) {
        e.preventDefault();
    }
});

</script>
<?php
error_reporting(0);
$perkUpdate = $_POST['perk_update'];
$reserid = $_POST['reservation_id_perk'];
$perkid = $_POST['perk_id_perk'];

//connection
error_reporting(0);
include 'signin.php';
if (!$con) {
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'SELECT id, stayid FROM reservation WHERE stayid = '.mysqli_real_escape_string($con, $reserid);
$result = mysqli_query($con, $sql);

//check reservation id
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
}

else {
    echo "<script type='text/javascript'>alert('The data entered for reservation id is incorrect or perks were never requested. Please check reservation id again.')</script>";
}

$sql1 = 'UPDATE perk SET perks = \''.mysqli_real_escape_string($con, $perkUpdate).'\' WHERE id = '.$row['id'].' AND perkid = '.mysqli_real_escape_string($con, $perkid);
mysqli_query($con, $sql1);

//check corresponding perk id
if (mysqli_affected_rows($con) == 0) {
    echo "<script type='text/javascript'>alert('The data entered for perk id is incorrect or perks were never requested. Please check your perk id again.')</script>";
}

else {
    echo "<script type='text/javascript'>alert('Perks Updated successfully')</script>";
}

?>
</body>
</html>