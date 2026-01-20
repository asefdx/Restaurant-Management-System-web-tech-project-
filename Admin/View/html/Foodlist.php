<?php
include "../../Model/mydb.php";
session_start();
$isLoggedIn= $_SESSION["isLogin"]?? false;
if(!$isLoggedIn){
    header("Location: ../../../Index.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Food List - Admin Dashboard</title>
    <link rel="stylesheet" href="../CSS/list.css">
</head>
<body>
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-brand">🍽️ Restaurant Admin</div>
            
            <ul class="nav-menu">
                <li class="nav-item">
                    <a href="Dashboard.php" class="nav-link">Home</a>
                </li>
                <li class="nav-item">
                    <a href="Foodlist.php" class="nav-link active">Food List</a>
                </li>
                <li class="nav-item">
                    <a href="userlist.php" class="nav-link">User List</a>
                </li>
                <li class="nav-item">
                    <a href="saleslist.php" class="nav-link">Sales List</a>
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
            <h1 class="page-title">Food List</h1>
            <div class="action-buttons">
               <a href="AddnewFood.php"> <button class="btn btn-add">Add Food</button></a>
            </div>
        </div>

        <div class="table-container">
            <table>
                <thead>
                    <tr>
                        <th>Food ID</th>
                        <th>Food Name</th>
                        <th>Category</th>
                        <th>Price</th>
                        <th>Status</th>
                        <th>Quantity</th>
                        <th>Actions</th>
                    </tr>
                </thead>
        <tbody>
<?php
$foods = getAllFoods();
$sl = 1;

foreach ($foods as $row) {
?>
    <tr>
        <td><?php echo $row["menu_id"]; ?></td>
        <td><?php echo $row['item_name']; ?></td>
        <td><?php echo $row['category']; ?></td>
        <td><?php echo $row['price']; ?>tk</td>
        <td><?php echo $row['status']; ?></td>
        <td><?php echo $row['quantity']; ?></td>
        <td>
            <div class="action-cell">
                <button class="btn btn-edit-row"
                        onclick="editFood(<?php echo htmlspecialchars(json_encode([
                            'menu_id' => $row['menu_id'],
                            'item_name' => $row['item_name'],
                            'category' => $row['category'],
                            'price' => $row['price'],
                            'status' => $row['status'],
                            'quantity'=> $row['quantity'],
                        ])); ?>)">
                    Edit
                </button>

                <button class="btn btn-delete"
                        onclick="deleteFood(<?php echo htmlspecialchars($row['menu_id']);?>)">
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
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="../../Controller/js/Foodlist.js"></script>
</body>
</html>
