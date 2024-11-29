<?php
include('db.php');

// Add Customer
if (isset($_POST['add_customer'])) {
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];

    $query = "INSERT INTO customer (title, first_name, last_name, contact_no, district) VALUES 
              ('$title', '$first_name', '$last_name', '$contact_no', '$district')";
    $conn->query($query);

    header('Location: customer.php');
}

// Edit Customer
if (isset($_POST['edit_customer'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $contact_no = $_POST['contact_no'];
    $district = $_POST['district'];

    $query = "UPDATE customer SET title='$title', first_name='$first_name', last_name='$last_name', 
              contact_no='$contact_no', district='$district' WHERE id=$id";
    $conn->query($query);

    header('Location: customer.php');
}

// Delete Customer
if (isset($_GET['delete_customer'])) {
    $id = $_GET['delete_customer'];
    echo 'Delete Customer{{id}}';
    $query = "DELETE FROM customer WHERE id=$id";
    $conn->query($query);

    header('Location: customer.php');
}
?>
