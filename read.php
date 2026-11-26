
<?php
include('dbconnection.php');

if (!isset($_GET['viewid'])) {
    die("No user ID provided.");
}

$id = intval($_GET['viewid']);

$stmt = mysqli_prepare($con, "SELECT * FROM tblusers WHERE ID = ?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);

$result = mysqli_stmt_get_result($stmt);
$user = mysqli_fetch_assoc($result);

mysqli_stmt_close($stmt);

if (!$user) {
    die("User record not found.");
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>View User Details</title>
</head>
<body>

<h2>User Details</h2>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>First Name</th>
        <td><?php echo htmlspecialchars($user['FirstName']); ?></td>
    </tr>

    <tr>
        <th>Last Name</th>
        <td><?php echo htmlspecialchars($user['LastName']); ?></td>
    </tr>

    <tr>
        <th>Mobile Number</th>
        <td><?php echo htmlspecialchars($user['MobileNumber']); ?></td>
    </tr>

    <tr>
        <th>Email</th>
        <td><?php echo htmlspecialchars($user['Email']); ?></td>
    </tr>

    <tr>
        <th>Address</th>
        <td><?php echo htmlspecialchars($user['Address']); ?></td>
    </tr>

    <tr>
        <th>Creation Date</th>
        <td><?php echo htmlspecialchars($user['CreationDate']); ?></td>
    </tr>
</table>

<br>

<a href="index.php">Back to User Records</a>

</body>
</html>
