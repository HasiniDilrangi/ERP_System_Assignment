<?php
include('db.php');

 // Fetch active districts from the districts table
 $districts_result = $conn->query("SELECT id, district FROM district WHERE active = 'yes'");

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch customer data
    $result = $conn->query("SELECT * FROM customer WHERE id=$id");
    $customer = $result->fetch_assoc();
}
?>

<?php include('includes/header.php'); ?>

<h2>Customer Management</h2>
<form action="customer_action.php" method="POST" class="mb-4">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="title">Title</label>
            <select class="form-control" name="title" required>
                <option value="" disabled selected>Select Title</option>
                <option value="Mr" >Mr</option>
                <option value="Mrs" >Mrs</option>
                <option value="Miss" >Miss</option>
                <option value="Dr" >Dr</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" required 
                   pattern="[A-Za-z\s]+" maxlength="50" title="Only alphabets and spaces allowed">
        </div>
        <div class="form-group col-md-4">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" required 
                   pattern="[A-Za-z\s]+" maxlength="50" title="Only alphabets and spaces allowed">
        </div>
        <div class="form-group col-md-4">
            <label for="contact_no">Contact Number</label>
            <input type="text" class="form-control" name="contact_no" required
                   pattern="^\d{10}$" title="Enter a valid 10-digit phone number">
        </div>
        <div class="form-group col-md-4">
            <label for="district">District</label>
            <select class="form-control" name="district" required>
                <option value="" disabled <?php if (empty($customer['district'])) echo 'selected'; ?>>Select District</option>
                <?php
                 // Loop through each district and create an option
                 while ($district = $districts_result->fetch_assoc()) {
                    echo "<option value='{$district['id']}' ";
                    echo ">{$district['district']}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>First Name</th>
            <th>Last Name</th>
            <th>Contact</th>
            <th>District</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
    <?php
        // Query to fetch customer data with district name
        $query = "SELECT c.id, c.title, c.first_name, c.last_name, c.contact_no, d.district AS district
                  FROM customer c
                  JOIN district d ON c.district = d.id";  // Perform JOIN on the district ID
                
        $result = $conn->query($query);

        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                    <td>{$row['id']}</td>
                    <td>{$row['title']}</td>
                    <td>{$row['first_name']}</td>
                    <td>{$row['last_name']}</td>
                    <td>{$row['contact_no']}</td>
                    <td>{$row['district']}</td>  <!-- Display the district name -->
                    <td>
                        <a href='edit_customer.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                        <a href='customer_action.php?delete_customer={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                    </td>
                </tr>";
        }
    ?>
    </tbody>
</table>

<?php include('includes/footer.php'); ?>
