<?php session_start(); 
ob_start();?>
<!DOCTYPE html>
<html lang="en">
<head>
        <meta charset="utf-8">
        <title>Happy Tails Hotel</title>
        <link href = "Happy Tails Hotel.css" rel="stylesheet">
</head>

<body>
            <form method='post'>
                <fieldset class="one">
                    <legend>Happy Tails Hotel</legend>
                    <div class="form">
                        <label for="fname">Receptionist's first name: <span class="star">*</span></label>
                        <input type="text" name="fname" id="fname" placeholder="Ex: John" title="Your first name">
                    </div>

                    <div class="form">
                        <label for="lname">Receptionist's last name: <span class="star">*</span></label>
                        <input type="text" name="lname" id="lname" placeholder="Ex: Smith" title="Your last name">
                    </div>

                    <div class="form">
                        <label for="pnumber">Phone number: <span class="star">*</span></label>
                        <input type="text" name="pnumber" id="pnumber" placeholder="Ex: 123-456-7890" title="Your phone number">
                    </div>

                    <div class="form">
                        <label for="recepid">ID#:<span class="star">*</span></label></label>
                        <input type="number" name="recepid" id="recepid" placeholder="Ex: 123456" title="Your ID number">
                    </div>
                    <div class="form">
                        <label for="email">Email: </label>
                        <input type="text" name="email" id="email" placeholder="Ex: abc@gmail.com" title="Your email address" disabled>&nbsp;
                        (OPTIONAL)
                    </div>

                    <div class="form">
                        <label for="password">Password: <span class="star">*</span></label>
                        <input type="password" name="password" id="password" minlength="8" maxlength="20" placeholder="Ex: ********" title="Your password">
                        <button id="showpassword"></button>
                    </div>

                    <div class="form">
                    <label for="transaction">Select a transaction: <span class="star">*</span></label>
                        <select name="transaction" id="transaction">
                            <option value="none">Choose a transaction</option>
                            <option value="Receptionist's Account">Search A Receptionist's Account</option>
                            <option value="Book A Stay">Book A Stay</option>
                            <option value="Cancel A Stay">Cancel A Stay</option>
                            <option value="Request Additional Perks During A Stay">Request Additional Perks During A Stay</option>
                            <option value="Cancel Additional Perks">Cancel Additional Perks</option>
                            <option value="Update Perks">Update Perks</option>
                            <option value="Create A New Client Account">Create A New Client Account</option>
                        </select>
                    </div>
                    
                    <div class="form" style="text-align: center;">
                        <label for="emailcheck">Email confirmation:</label>
                        <input type="checkbox" name="emailcheck" id="emailcheck">
                    </div>

                    <div id="btn">
                        <input type="submit" name="btn1" class="btn" id="btn1" value="Submit">
                        <input type="reset" name="btn2" class="btn" id="btn2" value="Clear all">
                    </div>
                    <a href="information" target="_blank">More information</a>&nbsp;
                    <a href="contact" target="_blank" style="margin-left: 30px">Contact</a>
                </fieldset>
            </form>  
            <script src="Happy Tails Hotel.js"></script>
        

<?php
error_reporting(0);
//session
$_SESSION['fname'] = $_POST['fname'];
$_SESSION['lname'] = $_POST['lname'];
$_SESSION['pnumber'] = $_POST['pnumber'];
$_SESSION['recepid'] = $_POST['recepid'];
$_SESSION['email'] = $_POST['email'];
$_SESSION['password'] = $_POST['password'];
$_SESSION['transaction'] = $_POST['transaction'];

//connecting to server
include 'signin.php';
if (!$con) {   
    die("Connection failed: " . mysqli_connect_error()); 
} 

//writting sql
$sql = 'SELECT password FROM receptionist WHERE recepid ='.mysqli_real_escape_string($con, $_POST['recepid']);
$result = mysqli_query($con, $sql);
if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    //verifying password
    if (password_verify($_POST['password'], $row['password'])) {
        $sql = 'SELECT* FROM receptionist WHERE fname =\''.mysqli_real_escape_string($con, $_POST['fname']).'\''.'AND lname =\''.mysqli_real_escape_string($con, $_POST['lname']).'\''.' AND recepid ='.mysqli_real_escape_string($con, $_POST['recepid']).' AND pnumber ='.mysqli_real_escape_string($con, $_POST['pnumber']).' AND password =\''.mysqli_real_escape_string($con, $row['password']).'\'';
        $result = mysqli_query($con, $sql);

        $sqlEmail = 'SELECT* FROM receptionist WHERE email = \''.mysqli_real_escape_string($con, $_POST['email']).'\''.'AND fname = \''.mysqli_real_escape_string($con, $_POST['fname']).'\'';
        $resultEmail = mysqli_query($con, $sqlEmail);

        if ((isset($_POST['email']) && mysqli_num_rows($resultEmail) == 1) || !isset($_POST['email']) || $_POST['email'] == '') {
            if (mysqli_num_rows($result) > 0) {
                
                //header for each option
                if ($_POST['transaction'] == "Receptionist's Account") {
                    header('Location:display_database.php');
                }

                else if ($_POST['transaction'] == "Book A Stay") {
                    header('Location:book_a_reservation.php');
                }

                else if ($_POST['transaction'] == "Cancel A Stay") {
                    header('Location:cancel_reservation.php');
                }

                else if ($_POST['transaction'] == "Request Additional Perks During A Stay") {
                    header('Location:request_perk.php');
                }

                else if ($_POST['transaction'] == "Cancel Additional Perks") {
                    header('Location:cancel_perks.php');
                }

                else if ($_POST['transaction'] == "Update Perks") {
                    header('Location:perk_update.php');
                }

                else if ($_POST['transaction'] == "Create A New Client Account") {
                    header('Location:create_an_account.php');
                }
            }

            else {
                echo "<script type='text/javascript'>alert('User cannot be found.')</script>";
            }
        }
        
        else {
            echo "<script type='text/javascript'>alert('User cannot be found.')</script>";
        }
    }
    
    else {
        echo "<script type='text/javascript'>alert('User cannot be found.')</script>";
    }
}

else {
    echo "<script type='text/javascript'>alert('User cannot be found.')</script>";
}

mysqli_close($con); 
?>

</body>
</html>

