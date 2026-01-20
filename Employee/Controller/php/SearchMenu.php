<?php
include "../../Model/mydb.php";

$keyword = $_POST["keyword"] ?? "";

$con = connection();

/* If search is empty → show all menu */
if (empty($keyword)) {
    $sql = "SELECT * FROM menu";
} else {
    $sql = "SELECT * FROM menu 
            WHERE item_name LIKE '%$keyword%' 
               OR category LIKE '%$keyword%'";
}

$result = mysqli_query($con, $sql);

/* Output table rows (HTML) */
while ($row = mysqli_fetch_assoc($result)) {
?>
<tr>
    <td>
        <input type="checkbox" name="menu_id[]" value="<?php echo $row['menu_id']; ?>">
    </td>
    <td><?php echo $row['menu_id']; ?></td>
    <td><?php echo $row['item_name']; ?></td>
    <td><?php echo $row['category']; ?></td>
    <td><?php echo $row['price']; ?></td>
    <td><?php echo $row['quantity']; ?></td>
    <td>
        <input type="number"
               name="qty[<?php echo $row['menu_id']; ?>]"
               value="1"
               min="1"
               max="<?php echo $row['quantity']; ?>">
    </td>
</tr>
<?php
}

mysqli_close($con);
exit();
