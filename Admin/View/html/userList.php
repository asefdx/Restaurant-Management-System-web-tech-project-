<?php
session_start();
include "../../Model/mydb.php";
$isLoggedIn = $_SESSION["isLogin"] ?? false;
if (!$isLoggedIn) {
	header("Location: ../../../Index.php");
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>User List - Admin Dashboard</title>
	<link rel="stylesheet" href="../CSS/list.css">
</head>
<body>
	<nav class="navbar">
		<div class="navbar-container">
			<div class="navbar-brand">Restaurant Admin</div>
			<ul class="nav-menu">
				<li class="nav-item"><a href="Dashboard.php" class="nav-link">Home</a></li>
				<li class="nav-item"><a href="foodlist.php" class="nav-link">Food List</a></li>
				<li class="nav-item"><a href="userlist.php" class="nav-link active">User List</a></li>
				<li class="nav-item"><a href="saleslist.php" class="nav-link">Sales List</a></li>
				<li class="nav-divider"></li>
				<li class="nav-item"><span class="user-info">Welcome, <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Admin'); ?></span></li>
				<li class="nav-item"><a href="../../Controller/php/logout.php" class="logout-btn">Logout</a></li>
			</ul>
		</div>
	</nav>

	<div class="main-content">
		<div class="page-header">
			<h1 class="page-title">User List</h1>
			<div class="action-buttons">
				<a href="AddNewUser.php"><button class="btn btn-add">Add User</button></a>
			</div>
		</div>

		<div class="table-container">
			<table aria-label="User list">
				<thead>
					<tr>
						<th>User ID</th>
						<th>Name</th>
						<th>Email</th>
						<th>password</th>
                        <th>Role</th>
						<th>Actions</th>
					</tr>
				</thead>
				<tbody>
<?php
$users = login();
$sl = 1;

foreach ($users as $row) {
?>
    <tr>
        <td><?php echo $row["user_id"]; ?></td>
        <td><?php echo $row['name']; ?></td>
        <td><?php echo $row['email']; ?></td>
        <td><?php echo $row['password']; ?></td>
        <td><?php echo $row['role']; ?></td>
        <td>
            <div class="action-cell">
                <button class="btn btn-edit-row"
                        onclick="editFood(<?php echo $row['user_id']; ?>)">
                    Edit
                </button>

                <button class="btn btn-delete"
                        onclick="deleteFood(<?php echo $row['user_id']; ?>)">
                    Delete
                </button>
            </div>
        </td>
    </tr>
<?php
    $sl++;
}
?>
</tbody>

			</table>
		</div>
	</div>
</body>
</html>
