<?php include('includes/header.php'); ?>

<h2 class="text-center my-4">Reports</h2>

<div class="container">
    <!-- Date Range Filter Form -->
    <form method="GET" action="" class="row g-3 mb-4">
        <div class="col-md-4">
            <label for="start_date" class="form-label">Start Date:</label>
            <input type="date" id="start_date" name="start_date" class="form-control" value="<?php echo $_GET['start_date'] ?? ''; ?>" required>
        </div>
        <div class="col-md-4">
            <label for="end_date" class="form-label">End Date:</label>
            <input type="date" id="end_date" name="end_date" class="form-control" value="<?php echo $_GET['end_date'] ?? ''; ?>" required>
        </div>
        <div class="col-md-4 d-flex align-items-end">
            <button type="submit" class="btn btn-primary w-100">Search</button>
        </div>
    </form>

    <?php

    include('db.php');

    // Check if date range is provided
    if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
        $start_date = $_GET['start_date'];
        $end_date = $_GET['end_date'];

        // Sanitize input to prevent SQL injection
        $start_date = $conn->real_escape_string($start_date);
        $end_date = $conn->real_escape_string($end_date);

        // Invoice Report Query
        $invoice_query = "
            SELECT 
                i.invoice_no AS 'Invoice Number',
                i.date AS 'Date',
                c.first_name AS 'Customer',
                c.district AS 'Customer District',
                i.item_count AS 'Item Count',
                i.amount AS 'Invoice Amount'
            FROM 
                invoice i
            JOIN 
                customer c ON i.customer = c.id
            WHERE 
                i.date BETWEEN '$start_date' AND '$end_date'
        ";
        $invoice_result = $conn->query($invoice_query);

        echo "<h3>Invoice Report</h3>";
        if ($invoice_result->num_rows > 0) {
            echo "<div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead class='table-dark'>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Date</th>
                                <th>Customer</th>
                                <th>Customer District</th>
                                <th>Item Count</th>
                                <th>Invoice Amount</th>
                            </tr>
                        </thead>
                        <tbody>";
            while ($row = $invoice_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Invoice Number']}</td>
                        <td>{$row['Date']}</td>
                        <td>{$row['Customer']}</td>
                        <td>{$row['Customer District']}</td>
                        <td>{$row['Item Count']}</td>
                        <td>{$row['Invoice Amount']}</td>
                      </tr>";
            }
            echo "      </tbody>
                    </table>
                  </div>";
        } else {
            echo "<p class='text-danger'>No records found for the selected date range.</p>";
        }

        // Invoice Item Report Query
        $invoice_item_query = "
            SELECT 
                im.invoice_no AS 'Invoice Number',
                i.date AS 'Invoiced Date',
                c.first_name AS 'Customer Name',
                itm.item_name AS 'Item Name',
                itm.item_code AS 'Item Code',
                itm.item_category AS 'Item Category',
                itm.unit_price AS 'Item Unit Price'
            FROM 
                invoice_master im
            JOIN 
                invoice i ON im.invoice_no = i.invoice_no
            JOIN 
                customer c ON i.customer = c.id
            JOIN 
                item itm ON im.item_id = itm.id
            WHERE 
                i.date BETWEEN '$start_date' AND '$end_date'
        ";
        $invoice_item_result = $conn->query($invoice_item_query);

        echo "<h3>Invoice Item Report</h3>";
        if ($invoice_item_result->num_rows > 0) {
            echo "<div class='table-responsive'>
                    <table class='table table-bordered'>
                        <thead class='table-dark'>
                            <tr>
                                <th>Invoice Number</th>
                                <th>Invoiced Date</th>
                                <th>Customer Name</th>
                                <th>Item Name</th>
                                <th>Item Code</th>
                                <th>Item Category</th>
                                <th>Item Unit Price</th>
                            </tr>
                        </thead>
                        <tbody>";
            while ($row = $invoice_item_result->fetch_assoc()) {
                echo "<tr>
                        <td>{$row['Invoice Number']}</td>
                        <td>{$row['Invoiced Date']}</td>
                        <td>{$row['Customer Name']}</td>
                        <td>{$row['Item Name']}</td>
                        <td>{$row['Item Code']}</td>
                        <td>{$row['Item Category']}</td>
                        <td>{$row['Item Unit Price']}</td>
                      </tr>";
            }
            echo "      </tbody>
                    </table>
                  </div>";
        } else {
            echo "<p class='text-danger'>No records found for the selected date range.</p>";
        }

//Item Report Query     
$invoice_item_query = "
    SELECT
        itm.item_name AS 'Item Name',
        itm.item_code AS 'Item Code',
        itm.item_category AS 'Item Category',
        SUM(itm.quantity) AS 'Item quantity'
    FROM 
        invoice_master im
    JOIN 
        invoice i ON im.invoice_no = i.invoice_no
    JOIN 
        customer c ON i.customer = c.id
    JOIN 
        item itm ON im.item_id = itm.id
    GROUP BY 
        itm.item_name, itm.item_code, itm.item_category
";

$invoice_item_result = $conn->query($invoice_item_query);

echo "<h3>Item Report</h3>";
if ($invoice_item_result->num_rows > 0) {
    echo "<div class='table-responsive'>
            <table class='table table-bordered'>
                <thead class='table-dark'>
                    <tr>                    
                        <th>Item Name</th>
                        <th>Item Code</th>
                        <th>Item Category</th>
                        <th>Item quantity</th>
                    </tr>
                </thead>
                <tbody>";
    while ($row = $invoice_item_result->fetch_assoc()) {
        echo "<tr>
                <td>{$row['Item Name']}</td>
                <td>{$row['Item Code']}</td>
                <td>{$row['Item Category']}</td>
                <td>{$row['Item quantity']}</td>
              </tr>";
    }
    echo "      </tbody>
            </table>
          </div>";
} else {
    echo "<p class='text-danger'>No records found for the selected date range.</p>";
}

    }

    $conn->close();
    ?>

</div>

<?php include('includes/footer.php'); ?>
