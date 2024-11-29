<?php
include('db.php');

if (isset($_POST['add_item'])) {
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $query = "INSERT INTO item (item_code, item_name, item_category, item_subcategory, quantity, unit_price) VALUES 
              ('$item_code', '$item_name', '$item_category', '$item_subcategory', $quantity, $unit_price)";
    $conn->query($query);

    header('Location: item.php');
}

// Edit item
if (isset($_POST['edit_item'])) {
    $id = $_POST['id'];
    $item_code = $_POST['item_code'];
    $item_name = $_POST['item_name'];
    $item_category = $_POST['item_category'];
    $item_subcategory = $_POST['item_subcategory'];
    $quantity = $_POST['quantity'];
    $unit_price = $_POST['unit_price'];

    $query = "UPDATE item SET item_code='$item_code',item_name='$item_name', item_category='$item_category', 
              item_subcategory='$item_subcategory', quantity='$quantity', unit_price='$unit_price'  WHERE id=$id";
    $conn->query($query);

    header('Location: item.php');
}

// Delete item
if (isset($_GET['delete_item'])) {
    $id = $_GET['delete_item'];
    $query = "DELETE FROM item WHERE id=$id";
    $conn->query($query);

    header('Location: item.php');
}
?>

