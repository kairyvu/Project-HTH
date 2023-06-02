<?php session_start();
ob_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="signin.css" rel="stylesheet">
    <link href="nav.css" rel="stylesheet">
</head>
<body>
<header>
    <nav>
        <ul style="margin-top:-49px;">
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

<div id="head"><h1>Happy Tails Hotel</h1></div>
    <div id="container">
    <table>
        <tr>
            <th>Receptionist First Name</th>
            <th>Receptionist Last name</th>
            <th>Receptionist ID</th>
            <th>Receptionist Phone</th>
            <th>Receptionist Email</th>
            <th>Pet Owner First Name</th>
            <th>Pet Owner Last Name</th>
            <th>Address and Phone Number</th>
            <th>Pet Owner ID</th>
            <th>Pet name & type</th>
            <th>Check in</th>
            <th>Check out</th>
            <th>Stay ID</th>
            <th>Perks</th>
            <th>Perks ID</th>
        </tr>
<?php
error_reporting(0);
include 'signin.php';

//connection
if (!$con) {   
    die("Connection failed: " . mysqli_connect_error()); 
}

//sql
$sql = 'SELECT receptionist.fname, receptionist.lname, receptionist.recepid, receptionist.pnumber, receptionist.email, Petowner.firstname, Petowner.lastname, reservation.address, Petowner.id, reservation.petname, reservation.checkin, reservation.checkout, reservation.stayid, perk.perks, perk.perkid FROM reservation LEFT JOIN perk ON reservation.stayid = perk.stayid INNER JOIN receptionist ON reservation.recepid = receptionist.recepid AND reservation.recepid = '.mysqli_real_escape_string($con, $_SESSION['recepid']).' INNER JOIN Petowner ON reservation.id = Petowner.id';
$result = mysqli_query($con, $sql);

//display
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        echo "<td>".$row['fname']."</td>";
        echo "<td>".$row['lname']."</td>";
        echo "<td>".$row['recepid']."</td>";
        echo "<td>".$row['pnumber']."</td>";
        echo "<td>".$row['email']."</td>";
        echo "<td>".$row['firstname']."</td>";
        echo "<td>".$row['lastname']."</td>";
        echo "<td>".$row['address']."</td>";
        echo "<td>".$row['id']."</td>";
        echo "<td>".$row['petname']."</td>";
        echo "<td>".$row['checkin']."</td>";
        echo "<td>".$row['checkout']."</td>";
        echo "<td>".$row['stayid']."</td>";
        echo "<td>".$row['perks']."</td>";
        echo "<td>".$row['perkid']."</td>";
        echo "</tr>";
    }
    echo "</table>";
}
mysqli_close($con);
?>
</body>
</html>