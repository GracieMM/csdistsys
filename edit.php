
<?php
include('dbconnection.php');

if (!isset($_GET['editid'])) {
    die("No user ID provided.");
}

$id = intval($_GET['editid']);

// Retrieve existing user details
$stmt = mysqli_prepare($con, "SELECT * FROM tblusers WHERE ID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);
mysqli_stmt_close($stmt);

if (!$user) {
    die("User record not found.");
}

// Update user details when the form is submitted
if (isset($_POST['update'])) {
    $fname = trim($_POST['fname']);
    $lname = trim($_POST['lname']);
    $contno = trim($_POST['contactno']);
    $email = trim($_POST['email']);
    $address = trim($_POST['address']);

    $stmt = mysqli_prepare(
        $con,
        "UPDATE tblusers SET FirstName=?, LastName=?, MobileNumber=?, Email=?, Address=? WHERE ID=?"
    );

    mysqli_stmt_bind_param(
        $stmt,
        "sssssi",
        $fname,
        $lname,
        $contno,
        $email,
        $address,
        $id
    );

    if (mysqli_stmt_execute($stmt)) {
        mysqli_stmt_close($stmt);
        header("Location: index.php");
        exit();
    } else {
        echo "Update failed. Please try again.";
    }
    mysqli_stmt_close($stmt);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit User</title>
</head>
<body>

<h2>Edit User Details</h2>

<form method="POST">

    <label>First Name:</label><br>
    <input type="text" name="fname"
    value="<?php echo htmlspecialchars($user['FirstName']); ?>" required>
    <br><br>

    <label>Last Name:</label><br>
    <input type="text" name="lname"
    value="<?php echo htmlspecialchars($user['LastName']); ?>" required>
    <br><br>

    <label>Mobile Number:</label><br>
    <input type="text" name="contactno"
    value="<?php echo htmlspecialchars($user['MobileNumber']); ?>" required>
    <br><br>

    <label>Email:</label><br>
    <input type="email" name="email"
    value="<?php echo htmlspecialchars($user['Email']); ?>" required>
    <br><br>

    <label>Address:</label><br>
    <textarea name="address" required><?php echo htmlspecialchars($user['Address']); ?></textarea>
    <br><br>

    <button type="submit" name="update">Update Record</button>

</form>

<br>
<a href="index.php">Back to User Records</a>

</body>
</html>
