# **ERP System** 

Welcome to the **ERP System**, your one-stop solution for generating insightful reports like **Invoice Reports**, **Invoice Item Reports**, and **Item Reports**. Built with PHP, MySQL, and Bootstrap, this app is easy to set up and get running in your local environment.

---

## **Assumptions** 🧐

Here are a few things we’ve assumed:
1. You’re working on a local development environment such as **XAMPP** or **WAMP**.
2. The database dump (`assignment.sql`) is included for quick setup.
3. You know how to extract `.rar` files and manage MySQL databases in phpMyAdmin.
4. Database credentials may differ; you can update them in `db.php`.

---

## **Getting Started** 🌟

### **1. Extract & Relocate**
1. Extract the `.rar` file containing the application to a folder.
2. Move the folder to the `htdocs` directory if using **XAMPP**, or the web root directory for **WAMP**.

### **2. Set Up the Database**
1. Launch your **XAMPP** or **WAMP** server.
2. Open your browser and navigate to [phpMyAdmin](http://localhost/phpmyadmin).
3. Create a new database named `assignment`.
4. Import the provided `assignment.sql` file:
   - Select the `assignment` database.
   - Go to the **"Import"** tab.
   - Upload `assignment.sql` and click **"Go"**. 

### **3. Configure Database Credentials**
- Open the project folder in your favorite code editor (e.g., **VS Code**).
- Locate the `db.php` file.
- Update the MySQL `username` and `password` fields to match your local setup. Example:

```php
$servername = "localhost";
$username = "root"; // Your MySQL username
$password = "";     // Your MySQL password (leave empty if none)
$dbname = "assignment";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
```

### **4. Run the Application**
1. Open your browser.
2. Navigate to:
   ```
   http://localhost/{your-folder-name}
   ```
   Replace `{your-folder-name}` with the name of the folder you saved in `htdocs`.

---

## **Features** ✨

### **1. Invoice Report**
- **Details:** Invoice Number, Date, Customer, Customer District, Item Count, Invoice Amount.
- **Filter:** Select a date range to filter invoices.

### **2. Invoice Item Report**
- **Details:** Invoice Number, Invoiced Date, Customer Name, Item Name, Item Code, Item Category, Item Unit Price.
- **Filter:** Select a date range to filter invoice items.

### **3. Item Report**
- **Details:** Unique Item Names (no repeats), Item Categories, Subcategories, and Quantities.

---

## **Troubleshooting** 🛠️

Having issues? Let’s get you back on track:
1. **Server Not Running?**
   - Ensure **XAMPP** or **WAMP** is started.
2. **Database Connection Error?**
   - Double-check the `username` and `password` in `db.php`.
3. **Database Not Found?**
   - Verify that the `assignment.sql` file was imported into phpMyAdmin.
4. **Blank Page?**
   - Make sure the app folder is correctly placed in the `htdocs` directory.

---

## **Why You'll Love This App** 

- Easy to set up and use.
- Fully responsive and clean UI with **Bootstrap**.
- Generate comprehensive reports with just a few clicks.
- Built for learning and practical use cases.

---

## **Author** 🖋️

**Hasini Dilrangi**  
&copy; 2024 - All Rights Reserved  

> "Good software is made with patience and precision. Enjoy exploring!"  

--- 

Let me know if you need any updates or enhancements! 😊
