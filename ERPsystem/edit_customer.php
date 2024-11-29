<?php
include('db.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    // Fetch customer data
    $result = $conn->query("SELECT * FROM customer WHERE id=$id");
    $customer = $result->fetch_assoc();
    
    // Fetch active districts from the districts table
    $districts_result = $conn->query("SELECT id, district FROM district WHERE active = 'yes'");
}
?>

<?php include('includes/header.php'); ?>

<h2>Edit Customer</h2>
<form action="customer_action.php" method="POST">
    <input type="hidden" name="id" value="<?php echo htmlspecialchars($customer['id']); ?>">
    <div class="form-row">
        <div class="form-group col-md-2">
            <label for="title">Title</label>
            <select class="form-control" name="title" required>
                <option value="Mr" <?php if ($customer['title'] == 'Mr') echo 'selected'; ?>>Mr</option>
                <option value="Mrs" <?php if ($customer['title'] == 'Mrs') echo 'selected'; ?>>Mrs</option>
                <option value="Miss" <?php if ($customer['title'] == 'Miss') echo 'selected'; ?>>Miss</option>
                <option value="Dr" <?php if ($customer['title'] == 'Dr') echo 'selected'; ?>>Dr</option>
            </select>
        </div>
        <div class="form-group col-md-4">
            <label for="first_name">First Name</label>
            <input type="text" class="form-control" name="first_name" 
                   value="<?php echo htmlspecialchars($customer['first_name']); ?>" 
                   required pattern="[A-Za-z\s]+" maxlength="50" 
                   title="Only alphabets and spaces allowed">
        </div>
        <div class="form-group col-md-4">
            <label for="last_name">Last Name</label>
            <input type="text" class="form-control" name="last_name" 
                   value="<?php echo htmlspecialchars($customer['last_name']); ?>" 
                   required pattern="[A-Za-z\s]+" maxlength="50" 
                   title="Only alphabets and spaces allowed">
        </div>
        <div class="form-group col-md-4">
            <label for="contact_no">Contact Number</label>
            <input type="text" class="form-control" name="contact_no" 
                   value="<?php echo htmlspecialchars($customer['contact_no']); ?>" 
                   required pattern="^\d{10}$" 
                   title="Enter a valid 10-digit phone number">
        </div>
        <div class="form-group col-md-4">
            <label for="district">District</label>
            <select class="form-control" name="district" required>
                <option value="" disabled <?php if (empty($customer['district'])) echo 'selected'; ?>>Select District</option>
                <?php
                // Loop through each district and create an option
                while ($district = $districts_result->fetch_assoc()) {
                    echo "<option value='{$district['id']}' ";
                    if ($customer['district'] == $district['id']) {
                        echo 'selected';
                    }
                    echo ">{$district['district']}</option>";
                }
                ?>
            </select>
        </div>
    </div>
    <button type="submit" name="edit_customer" class="btn btn-primary">Save Changes</button>
</form>

<?php include('includes/footer.php'); ?>
