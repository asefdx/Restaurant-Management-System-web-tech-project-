<?php
session_start();
include "../../Model/mydb.php";

/* Initialize cart */
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}












/* ADD TO CART */
if (isset($_POST['add_to_cart'])) {

    if (!isset($_POST['menu_id'])) {
        header("Location: ../../View/html/menu.php");
        exit;
    }

    foreach ($_POST['menu_id'] as $menu_id) {

        $qty = $_POST['qty'][$menu_id];

        // Get food info from DB - query directly
        $con = connection();
        $sql = "SELECT * FROM menu WHERE menu_id = $menu_id";
        $result = mysqli_query($con, $sql);
        $food = mysqli_fetch_assoc($result);
        mysqli_close($con);

        if (!$food) {
            continue;
        }

        // add or update cart
        if (isset($_SESSION['cart'][$menu_id])) {
            $_SESSION['cart'][$menu_id]['qty'] += $qty;
        } else {
            $_SESSION['cart'][$menu_id] = [
                'menu_id' => $food['menu_id'],
                'item_name' => $food['item_name'],
                'price' => $food['price'],
                'qty' => $qty
            ];
        }
    }

    // redirect to cart page
    header("Location: ../../View/html/cart.php");
    exit;
}
