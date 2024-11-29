<?php
include('db.php');

// Fetch item details based on the provided ID
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $result = $conn->query("SELECT * FROM item WHERE id=$id");
    $item = $result->fetch_assoc();
}

// Fetch categories and subcategories
$item_category_results = $conn->query("SELECT id, category FROM item_category");
$item_subcategory_results = $conn->query("SELECT id, sub_category FROM item_subcategory");
?>

<?php include('includes/header.php'); ?>

<h2>Edit Item</h2>
<form action="item_action.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $item['id']; ?>">
    <div class="form-row">
        <div class="form-group col-md-3">
            <label for="item_code">Item Code</label>
            <input type="text" class="form-control" name="item_code" value="<?php echo $item['item_code']; ?>" 
                   required pattern="^[a-zA-Z0-9\-]+$" 
                   title="Item code should contain only letters, numbers, or dashes.">
        </div>
        <div class="form-group col-md-3">
            <label for="item_name">Item Name</label>
            <input type="text" class="form-control" name="item_name" value="<?php echo $item['item_name']; ?>" 
                   required minlength="2" 
                   title="Item name must be at least 2 characters long.">
        </div>
        <div class="form-group col-md-3">
            <label for="item_category">Category</label>
            <select class="form-control" name="item_category" required>
                <option value="" disabled>Select Category</option>
                <?php
                // Populate category dropdown
                while ($category = $item_category_results->fetch_assoc()) {
                    $selected = $item['item_category'] == $category['id'] ? 'selected' : '';
                    echo "<option value='{$category['id']}' $selected>{$category['category']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="item_subcategory">Sub-Category</label>
            <select class="form-control" name="item_subcategory" required>
                <option value="" disabled>Select Sub-Category</option>
                <?php
                // Populate sub-category dropdown
                while ($subcategory = $item_subcategory_results->fetch_assoc()) {
                    $selected = $item['item_subcategory'] == $subcategory['id'] ? 'selected' : '';
                    echo "<option value='{$subcategory['id']}' $selected>{$subcategory['sub_category']}</option>";
                }
                ?>
            </select>
        </div>
        <div class="form-group col-md-3">
            <label for="quantity">Quantity</label>
            <input type="number" class="form-control" name="quantity" value="<?php echo $item['quantity']; ?>" 
                   required min="1" 
                   title="Quantity must be a positive number.">
        </div>
        <div class="form-group col-md-3">
            <label for="unit_price">Unit Price</label>
            <input type="number" class="form-control" name="unit_price" step="0.01" value="<?php echo $item['unit_price']; ?>" 
                   required min="0.01" 
                   title="Unit price must be a positive value with up to two decimal places.">
        </div>
    </div>
    <button type="submit" name="edit_item" class="btn btn-primary">Save Changes</button>
</form>

<?php include('includes/footer.php'); ?>
