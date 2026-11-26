
<?php
include('dbconnection.php');

if (isset($_POST['submit'])) {
    $fname = $_POST['fname'];
    $lname = $_POST['lname'];
    $contno = $_POST['contactno'];
    $email = $_POST['email'];
    $add = $_POST['address'];

    $query = mysqli_query($con, "INSERT INTO tblusers
    (FirstName, LastName, MobileNumber, Email, Address)
    VALUES ('$fname', '$lname', '$contno', '$email', '$add')");

    if ($query) {
        echo "<script>alert('You have successfully inserted the data');</script>";
        echo "<script>window.location.href='index.php';</script>";
    } else {
        echo "Something went wrong. Please try again.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Insert User</title>
</head>
<body>

<h2>Register User</h2>

<form method="POST">
    <label>First Name:</label><br>
    <input type="text" name="fname" required><br><br>

    <label>Last Name:</label><br>
    <input type="text" name="lname" required><br><br>

    <label>Mobile Number:</label><br>
    <input type="number" name="contactno" required><br><br>

    <label>Email:</label><br>
    <input type="email" name="email" required><br><br>

    <label>Address:</label><br>
    <textarea name="address" required></textarea><br><br>

    <button type="submit" name="submit">Submit</button>
</form>

</body>
</html>
