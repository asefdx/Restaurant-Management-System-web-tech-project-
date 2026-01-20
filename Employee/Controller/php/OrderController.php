<?php
session_start();
include "../../Model/mydb.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cart = $_SESSION['cart'] ?? [];
    
    // Get employee_id from session
    $employee_id = $_SESSION['emp_id'] ?? $_SESSION['user_id'] ?? $_SESSION['employee_id'] ?? 1;
    
    if (empty($cart)) {
        header("Location: ../../View/html/cart.php");
        exit;
    }
    
    // Calculate grand total and save each cart item as an order
    $grand_total = 0;
    $order_ids = [];
    
    foreach ($cart as $item) {
        $total_amount = $item['price'] * $item['qty'];
        $grand_total += $total_amount;
        
        $con = connection();
        $order_date = date("Y-m-d H:i:s");
        $menu_id = $item['menu_id'];
        
        $sql = "INSERT INTO orders (menu_id, employee_id, order_date, total_amount) VALUES ('$menu_id', '$employee_id', '$order_date', '$total_amount')";
        
        $result = mysqli_query($con, $sql);
        
        if ($result) {
            $order_ids[] = mysqli_insert_id($con);
        }
        
        mysqli_close($con);
    }
    
    // Fetch order details from database
    $con = connection();
    $order_ids_str = implode(",", $order_ids);
    $sql = "SELECT o.order_id, m.item_name, o.menu_id, o.employee_id, o.order_date, o.total_amount FROM orders o JOIN menu m ON o.menu_id = m.menu_id WHERE o.order_id IN ($order_ids_str) ORDER BY o.order_date DESC";
    
    $orders = [];
    $result = mysqli_query($con, $sql);
    
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){
            $orders[] = $row;
        }
    }
    
    mysqli_close($con);
    
    // Calculate invoice grand total
    $invoice_grand_total = 0;
    foreach ($orders as $order) {
        $invoice_grand_total += $order['total_amount'];
    }
    
    $order_date = !empty($orders) ? $orders[0]['order_date'] : date("Y-m-d H:i:s");
    
    // Clear the cart after saving orders
    $_SESSION['cart'] = [];
    
    // Display invoice
    ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Invoice</title>
    </head>
    <body>
    
    <div style="text-align:center;">
    
    <h2>Order Invoice</h2>
    
    <p>Order IDs: <?php echo implode(", ", $order_ids); ?></p>
    <p>Order Date: <?php echo $order_date; ?></p>
    <p>Employee ID: <?php echo $employee_id; ?></p>
    
    <table border="1" style="margin:20px auto;">
        <tr>
            <th>Food Name</th>
            <th>Order ID</th>
            <th>Total Amount</th>
        </tr>
    
    <?php
    foreach ($orders as $order) {
    ?>
        <tr>
            <td><?php echo $order['item_name']; ?></td>
            <td><?php echo $order['order_id']; ?></td>
            <td><?php echo $order['total_amount']; ?></td>
        </tr>
    <?php } ?>
        <tr>
            <td colspan="1">Grand Total</td>
            <td colspan="2"><?php echo $invoice_grand_total; ?></td>
        </tr>
    </table>
    
    <br>
    <p>Order placed successfully!</p>
    
    <br>
    <a href="../../View/html/dashboard.php"><button>Back to Dashboard</button></a>
    <a href="../../View/html/menu.php"><button>Place Another Order</button></a>
    
    </div>
    
    </body>
    </html>
    <?php
    exit;
}
?>