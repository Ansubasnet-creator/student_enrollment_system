<?php
require_once "../config/auth.php";
require_once "../config/db.php";

$result = mysqli_query($conn, "SELECT * FROM students");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

<div class="container">
    <h2>Student Enrollment</h2>

    <a href="add.php">+ Add Student</a>

    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Year</th>
            <th>Action</th>
        </tr>

        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <tr>
            <td><?= $row["name"] ?></td>
            <td><?= $row["email"] ?></td>
            <td><?= $row["study_year"] ?></td>
            <td>
                <a href="edit.php?id=<?= $row["id"] ?>">Edit</a> |
                <a href="delete.php?id=<?= $row["id"] ?>"
                   onclick="return confirm('Delete this student?')">
                   Delete
                </a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <form action="logout.php" method="POST" style="margin-top:15px;">
        <button class="btn">Logout</button>
    </form>
</div>

</body>
</html>
