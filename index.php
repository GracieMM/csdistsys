
<?php
include('dbconnection.php');

// Delete a user record
if (isset($_POST['delete'])) {
    $rid = intval($_POST['id']);

    $stmt = mysqli_prepare($con, "DELETE FROM tblusers WHERE ID = ?");
    mysqli_stmt_bind_param($stmt, "i", $rid);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header("Location: index.php");
    exit();
}

// Retrieve all user records
$query = mysqli_query($con, "SELECT * FROM tblusers ORDER BY ID DESC");
?>

<!DOCTYPE html>
<html>
<head>
    <title>User Records</title>
</head>
<body>

<h2>Registered Users</h2>

<a href="insert.php">Add New User</a>

<br><br>

<table border="1" cellpadding="10" cellspacing="0">
    <tr>
        <th>ID</th>
        <th>First Name</th>
        <th>Last Name</th>
        <th>Mobile Number</th>
        <th>Email</th>
        <th>Address</th>
        <th>Creation Date</th>
        <th>Action</th>
    </tr>

    <?php while ($row = mysqli_fetch_assoc($query)) { ?>
    <tr>
        <td><?php echo $row['ID']; ?></td>
        <td><?php echo htmlspecialchars($row['FirstName']); ?></td>
        <td><?php echo htmlspecialchars($row['LastName']); ?></td>
        <td><?php echo htmlspecialchars($row['MobileNumber']); ?></td>
        <td><?php echo htmlspecialchars($row['Email']); ?></td>
        <td><?php echo htmlspecialchars($row['Address']); ?></td>
        <td><?php echo $row['CreationDate']; ?></td>

        <td>
            <a href="read.php?viewid=<?php echo $row['ID']; ?>">View</a>
            <a href="edit.php?editid=<?php echo $row['ID']; ?>">Edit</a>
            <form method="POST" onsubmit="return confirm('Are you sure you want to delete this record?');">
                <input type="hidden" name="id" value="<?php echo $row['ID']; ?>">
                <button type="submit" name="delete">Delete</button>
            </form>
        </td>
    </tr>
    <?php } ?>

</table>

</body>
</html>
