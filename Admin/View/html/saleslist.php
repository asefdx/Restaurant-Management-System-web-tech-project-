<?php
include "../../Model/mydb.php";
session_start();
$isLoggedIn = $_SESSION["isLogin"] ?? false;
if (!$isLoggedIn) {
	header("Location: ../../../Index.php");
	exit();
}

$sales = getSalesList();


?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Sales List - Admin Dashboard</title>
	<link rel="stylesheet" href="../CSS/list.css">
</head>
<body>
	<nav class="navbar">
		<div class="navbar-container">
			<div class="navbar-brand">Restaurant Admin</div>

			<ul class="nav-menu">
				<li class="nav-item">
					<a href="Dashboard.php" class="nav-link">Home</a>
				</li>
				<li class="nav-item">
					<a href="Foodlist.php" class="nav-link">Food List</a>
				</li>
				<li class="nav-item">
					<a href="userlist.php" class="nav-link">User List</a>
				</li>
				<li class="nav-item">
					<a href="saleslist.php" class="nav-link active">Sales List</a>
				</li>
				<li class="nav-divider"></li>
				<li class="nav-item">
					<span class="user-info">Welcome, <?php echo htmlspecialchars($_SESSION['user_email'] ?? 'Admin'); ?></span>
				</li>
				<li class="nav-item">
					<a href="../../Controller/php/logout.php" class="logout-btn">Logout</a>
				</li>
			</ul>
		</div>
	</nav>

	<div class="main-content">
		<div class="page-header">
			<h1 class="page-title">Sales Overview</h1>
		</div>

		<div class="table-container">
			<table>
				<thead>
					<tr>
						<th>Sale ID</th>
						<th>Food Item</th>
						<th>Category</th>
						<th>Menu ID</th>
						<th>Employee ID</th>
						<th>Order Date</th>
						<th>Total Amount</th>
					</tr>
				</thead>
				<tbody>
					<?php if (empty($sales)): ?>
						<tr>
							<td colspan="7" class="empty-state">No sales data available yet.</td>
						</tr>
					<?php else: ?>
						<?php foreach ($sales as $sale): ?>
							<tr>
								<td><?php echo htmlspecialchars($sale['order_id']); ?></td>
								<td><?php echo htmlspecialchars($sale['item_name'] ?? 'Unknown Item'); ?></td>
								<td><?php echo htmlspecialchars($sale['category'] ?? 'N/A'); ?></td>
								<td><?php echo htmlspecialchars($sale['menu_id']); ?></td>
								<td><?php echo htmlspecialchars($sale['employee_id']); ?></td>
								<td><?php echo htmlspecialchars(date('M d, Y h:i A', strtotime($sale['order_date']))); ?></td>
								<td><?php echo number_format((float)($sale['total_amount'] ?? 0), 2); ?></td>
							</tr>
						<?php endforeach; ?>
					<?php endif; ?>
				</tbody>
			</table>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</body>
</html>
