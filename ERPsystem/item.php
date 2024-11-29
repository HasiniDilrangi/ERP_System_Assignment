<?php
include('db.php');

// Fetch the categories and subcategories
$item_category_results = $conn->query("SELECT id, category FROM item_category");
$item_subcategory_results = $conn->query("SELECT id, sub_category FROM item_subcategory");
?>

<?php include('includes/header.php'); ?>

<h2>Item Management</h2>

<form action="item_action.php" method="POST" class="mb-4" id="itemForm">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="item_code">Item Code</label>
            <input type="text" class="form-control" name="item_code" id="item_code" required 
                   pattern="^[a-zA-Z0-9\-]+$" title="Item code should contain only letters, numbers, or dashes.">
        </div>
        <div class="form-group col-md-3">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" name="item_name" id="item_name" required minlength="2" 
                   title="Item name must be at least 2 characters long.">
        </div>
        <div class="form-group col-md-3">
            <label for="item_category">Category</label>
            <select class="form-control" name="item_category" id="item_category" required>
                <option value="" disabled selected>Select Category</option>
                <?php
                // Populate category dropdown
                while ($category = $item_category_results->fetch_assoc()) {
                    echo "<option value='{$category['id']}'>{$category['category']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="item_subcategory">Sub-Category</label>
            <select class="form-control" name="item_subcategory" id="item_subcategory" required>
                <option value="" disabled selected>Select Sub-Category</option>
                <?php
                // Populate sub-category dropdown
                while ($subcategory = $item_subcategory_results->fetch_assoc()) {
                    echo "<option value='{$subcategory['id']}'>{$subcategory['sub_category']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" id="quantity" required min="1" 
                   title="Quantity must be a positive number.">
        </div>
        <div class="form-group col-md-3">
            <label for="unit_price">Unit Price</label>
            <input type="number" class="form-control" name="unit_price" id="unit_price" step="0.01" required min="0.01" 
                   title="Unit price must be a positive value with up to two decimal places.">
        </div>
    </div>
    <button type="submit" name="add_item" class="btn btn-primary">Add Item</button>
</form>

<table class="table table-bordered">
    <thead>
        <tr>
            <th>ID</th>
            <th>Item Code</th>
            <th>Item Name</th>
            <th>Category</th>
            <th>Sub-Category</th>
            <th>Quantity</th>
            <th>Unit Price</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php
        // Fetch and display items with category and sub-category names
        $query = "SELECT i.id, i.item_code, i.item_name, c.category AS item_category, 
                         s.sub_category AS item_subcategory, i.quantity, i.unit_price
                  FROM item i
                  JOIN item_category c ON i.item_category = c.id
                  JOIN item_subcategory s ON i.item_subcategory = s.id";

        $result = $conn->query($query);
        while ($row = $result->fetch_assoc()) {
            echo "<tr>
                <td>{$row['id']}</td>
                <td>{$row['item_code']}</td>
                <td>{$row['item_name']}</td>
                <td>{$row['item_category']}</td>
                <td>{$row['item_subcategory']}</td>
                <td>{$row['quantity']}</td>
                <td>{$row['unit_price']}</td>
                <td>
                    <a href='edit_item.php?id={$row['id']}' class='btn btn-warning btn-sm'>Edit</a>
                    <a href='item_action.php?delete_item={$row['id']}' class='btn btn-danger btn-sm'>Delete</a>
                </td>
            </tr>";
        }
        ?>
    </tbody>
</table>

<?php include('includes/footer.php'); ?>
